<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\Card\AttachRequest;
use App\Repositories\CardRepository;
use App\Repositories\SubscriptionRepository;
use App\Repositories\TransactionRepository;
use App\Services\Billing\BillingService;
use App\Services\Billing\CloudPaymentsService;
use App\Http\Controllers\Controller;
use App\Services\CardService;
use App\Services\TransactionService;
use App\Support\Billing\Error\Required3DSError;
use App\Support\Billing\Error\TransactionError;
use App\Support\Billing\Results\ChargeFailed;
use App\Support\Billing\Results\ChargeSucceeded;
use App\Support\Billing\Results\Need3DSecure;
use CloudPayments\Exception\PaymentException;
use CloudPayments\Manager;
use CloudPayments\Model\Required3DS;
use CloudPayments\Model\Transaction;
use App\Models\Transaction as PaymentTransaction;
use Illuminate\Http\Request;

class CardController extends BaseController
{
    /**
     * @param CardRepository $cardRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(CardRepository $cardRepo)
    {
        $cards = $cardRepo->getAllByVendor($this->getVendor());

        return view('dashboard.cards.index', [
            'cards' => $cards
        ]);
    }

    /**
     * @param CardRepository $cardRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CardRepository $cardRepo)
    {
        return view('dashboard.cards.create');
    }

    public function attach(
        AttachRequest $request,
        SubscriptionRepository $subscriptionRepo,
        BillingService $billingService,
        CardService $cardService
    )
    {
        $vendor = $this->getVendor();
        $subscription = $subscriptionRepo->getActiveByVendor($vendor);

        $transaction = $billingService->attachCard(
            $vendor,
            $subscription,
            $request->ip(),
            $request->input('name'),
            $request->input('cryptogram')
        );

        if ($transaction instanceof Required3DSError) {
            return response()->json([
                '3DSecure'  => false,
                'success'   => false
            ]);
        } elseif ($transaction instanceof Need3DSecure) {
            $transactionInfo = $transaction->getTransaction();

            return response()->json(['3DSecure' => true,
                'transactionData' => [
                    'TransactionId' => $transactionInfo->getId(),
                    'Token'         => $transactionInfo->getCardToken(),
                    'Url'           => $transactionInfo->getUrl()
                ]]);
        } elseif ($transaction instanceof ChargeSucceeded) {

            return response()->json([
                '3DSecure'  => false,
                'success'   => true
            ]);
        }
    }

    public function confirm3DS(
        Request $request,
        BillingService $billingService,
        SubscriptionRepository $subscriptionRepo,
        CardService $cardService
    )
    {
        $vendor = $this->getVendor();
        $subscription = $subscriptionRepo->getActiveByVendor($vendor);

        $transaction = $billingService->confirmCard3DS(
            $request->input('MD'),
            $request->input('PaRes')
        );

        if ($transaction instanceof TransactionError) {
            return $this->error(
                $transaction->getErrorMessage(),
                route('dashboard.cards.create')
            );
        } elseif ($transaction instanceof ChargeSucceeded) {

            $transactionInfo = $transaction->getTransaction();

            $card = $cardService->create(
                $vendor,
                $subscription,
                $transactionInfo
            );

            if ($card === null) {
                return $this->error(
                    'Не удалось создать карту.',
                    route('dashboard.cards')
                );
            }

            return $this->success(
                'Карта привязана.',
                route('dashboard.cards')
            );
        }
    }

    /**
     * @param string $id
     * @param CardRepository $cardRepo
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function delete(string $id, CardRepository $cardRepo)
    {
        $card = $cardRepo->findById($id);
        if ($card === null) {
            return $this->error('Товар не найден.');
        }

        $cardRepo->delete($card);

        return $this->warning(
            'Карта удалена.',
            route('dashboard.cards')
        );
    }
}
