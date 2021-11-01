<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2">2021©</span>
            <a href="{{ env('APP_URL') }}" target="_blank" class="text-dark-75 text-hover-primary">{{ env('APP_NAME') }}</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Nav-->
        <div class="nav nav-dark order-1 order-md-2">
            @foreach($pages as $page)
                <a href="{{ route('page', $page->slug) }}" target="_blank" class="nav-link pr-3 pl-0">{{ $page->title }}</a>
            @endforeach
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Container-->
</div>

<div class="modal fade" tabindex="-1" id="modal_donation">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                @csrf
                <div class="modal-body text-center">
                    <p>Effectuer une donation à <strong>Transport Fever France</strong></p>
                    <input type="hidden" name="cmd" value="_donations">
                    <input type="hidden" name="business" value="paypal@transportfeverfrance.fr">
                    <input type="hidden" name="item_name" value="Donation">
                    <input type="hidden" name="currency_code" value="EUR">
                    <input type="hidden" name="notify_url" value="{{ route('donation.notify_url') }}">
                    <input type="hidden" name="cancel_return" value="{{ route('donation.cancelled') }}">
                    <input type="hidden" name="return" value="{{ route('donation.success') }}">

                    <div class="col-md-4 offset-md-4">
                        <label for="">Donation Amount</label>
                        <input type="number" name="amount" class="form-control" value="10" >
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
