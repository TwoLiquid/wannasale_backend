<?php

namespace App\Repositories;

use App\Models\Item;
use App\Models\Request;
use App\Models\RequestMessage;
use Illuminate\Database\Eloquent\Collection;

class RequestMessageRepository
{
    /**
     * @param Request $request
     * @return RequestMessage|null
     */
    public function getForRequest(Request $request)
    {
        /** @var RequestMessage|null $requestMessage */
        $requestMessage = $request->messages()
            ->orderBy('created_at', 'desc')
            ->get();

        return $requestMessage;
    }

    /**
     * @param Request $request
     * @param string $id
     * @return RequestMessage|null
     */
    public function findForRequestById(Request $request, string $id) : ?RequestMessage
    {
        /** @var RequestMessage|null $request */
        $requestMessage = $request->messages()
            ->find($id);

        return $requestMessage;
    }

    /**
     * @param Request $request
     * @param Item $item
     * @return RequestMessage|null
     */
    public function findForRequestByItem(Request $request, Item $item) : ?RequestMessage
    {
        /** @var RequestMessage|null $requestMessage */
        $requestMessage = $request->messages()
            ->where('item_id', '=', $item->id)
            ->get();

        return $requestMessage;
    }

    /**
     * @param Request $request
     * @param int $author
     * @param string $title
     * @param string $text
     * @param int|null $offered_price
     * @return RequestMessage
     */
    public function createForRequest(
        Request $request,
        int $author,
        string $title,
        string $text,
        ?int $offered_price
    ) : RequestMessage {

        /** @var RequestMessage|null $requestMessage */
        $requestMessage = $request->messages()
            ->create([
                'request_id'    => $request->id,
                'author'        => $author,
                'title'         => $title,
                'text'          => $text,
                'seen'          => false,
                'offered_price' => $offered_price
            ]);

        return $requestMessage;
    }

    /**
     * @param RequestMessage $requestMessage
     * @param int $price
     * @return RequestMessage
     */
    public function setPrice(RequestMessage $requestMessage, int $price) : RequestMessage
    {
        /** @var RequestMessage|null $requestMessage */
        $requestMessage->update([
            'offered_price' => $price
        ]);

        return $requestMessage;
    }

    /**
     * @param RequestMessage $requestMessage
     * @throws \Exception
     */
    public function delete(RequestMessage $requestMessage) : void
    {
        $requestMessage->delete();
    }
}
