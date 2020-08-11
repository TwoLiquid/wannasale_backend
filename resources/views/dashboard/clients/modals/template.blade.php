<div class="modal fade slide-up disable-scroll show" id="modalClientsMerge" tabindex="-1" role="dialog" data-current-client-id="" data-current-client-name="" data-current-client-phone="">
    <div class="modal-dialog">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-header clearfix text-left">
                    <h5 class="semi-bold m-t-0">Cвязать клиентов</h5>
                    <p class="p-b-10" id="modalSimilarInfo">Выберите клиента, с которым вы хотите связать текущего</p>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="mergeClientsForm" class="inline no-margin full-width with-loading">
                        {!! csrf_field() !!}

                        <table class="table table-condensed no-footer" role="grid" id="modalSimilarTable">
                            <thead>
                            <tr role="row">
                                <th style="width: 40%" rowspan="1" colspan="1">Имя</th>
                                <th style="width: 30%;" rowspan="1" colspan="1">Телефон</th>
                                <th style="width: 30%;" class="text-right" rowspan="1" colspan="1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <table class="table table-condensed no-footer" role="grid" id="modalMergeTable">
                            <thead>
                            <tr role="row">
                                <th style="width: 40%" rowspan="1" colspan="1">Имя</th>
                                <th style="width: 30%;" rowspan="1" colspan="1">Телефон</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <div id="modalSimilarSecondStep">
                        </div>

                        <input type="hidden" id="mergeName" name="name" value="">
                        <input type="hidden" id="mergePhone" name="phone" value="">
                    </form>
                    <div class="row m-t-10">
                        <div class="col-md-5">
                            <button type="button" class="btn btn-sm btn-default no-margin" data-dismiss="modal">Отмена</button>
                        </div>
                        <div class="col-md-7" id="modalClientMergeChoose">
                            <button type="button" class="btn btn-sm btn-primary no-margin pull-right" disabled="disabled">Выбрать</button>
                        </div>
                        <div class="col-md-7" id="modalClientMergeSubmit" style="display: none;">
                            <!-- <a href="#" id="radioOffButton" class="btn btn-sm btn-default no-margin pull-left">Снять выделенное</a> -->
                            <button type="submit" class="btn btn-sm btn-primary no-margin pull-right">Связать</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>