<?php

namespace App\Http\Controllers\Api\Back\Accounting;

use App\Helpers\Format;
use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\Accounting\Bank;
use App\Models\Accounting\Purchase;
use App\Models\Accounting\Sale;
use App\Models\UserActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AccountingController extends Controller
{
    public function getSalesStat()
    {
        $janv = Sale::query()->whereBetween('created_at', [now()->year . '-01-01', now()->year . '-01-31'])->sum('amount');
        $fev = Sale::query()->whereBetween('created_at', [now()->year . '-02-01', now()->year . '-02-28'])->sum('amount');
        $mars = Sale::query()->whereBetween('created_at', [now()->year . '-03-01', now()->year . '-03-31'])->sum('amount');
        $avr = Sale::query()->whereBetween('created_at', [now()->year . '-04-01', now()->year . '-04-30'])->sum('amount');
        $mai = Sale::query()->whereBetween('created_at', [now()->year . '-05-01', now()->year . '-05-31'])->sum('amount');
        $juin = Sale::query()->whereBetween('created_at', [now()->year . '-06-01', now()->year . '-06-30'])->sum('amount');
        $jul = Sale::query()->whereBetween('created_at', [now()->year . '-07-01', now()->year . '-07-31'])->sum('amount');
        $aout = Sale::query()->whereBetween('created_at', [now()->year . '-08-01', now()->year . '-08-31'])->sum('amount');
        $sept = Sale::query()->whereBetween('created_at', [now()->year . '-09-01', now()->year . '-09-30'])->sum('amount');
        $oct = Sale::query()->whereBetween('created_at', [now()->year . '-10-01', now()->year . '-10-31'])->sum('amount');
        $nov = Sale::query()->whereBetween('created_at', [now()->year . '-11-01', now()->year . '-11-30'])->sum('amount');
        $dec = Sale::query()->whereBetween('created_at', [now()->year . '-12-01', now()->year . '-12-31'])->sum('amount');

        $total = $janv + $fev + $mars + $avr + $mai + $juin + $jul + $aout + $sept + $oct + $nov + $dec;

        return response()->json(["data" => [$janv, $fev, $mars, $avr, $mai, $juin, $jul, $aout, $sept, $oct, $nov, $dec], "sum" => Format::number_format($total)]);
    }

    public function getSalesAmount()
    {
        $annual = Sale::query()->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()])->sum('amount');
        $monthly = Sale::query()->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount');
        $daily = Sale::query()->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])->sum('amount');

        return response()->json(["yearly" => Format::number_format($annual), "monthly" => Format::number_format($monthly), "daily" => Format::number_format($daily)]);
    }

    public function getPurchaseAmount()
    {
        $annual = Purchase::query()->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()])->sum('amount');
        $monthly = Purchase::query()->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount');
        $daily = Purchase::query()->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])->sum('amount');

        return response()->json(["yearly" => Format::number_format($annual), "monthly" => Format::number_format($monthly), "daily" => Format::number_format($daily)]);
    }

    public function getBankAmount()
    {
        $annual = Bank::query()->whereBetween('created_at', [now()->startOfYear(), now()->endOfYear()])->sum('amount');
        $monthly = Bank::query()->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount');
        $daily = Bank::query()->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])->sum('amount');

        return response()->json(["yearly" => Format::number_format($annual), "monthly" => Format::number_format($monthly), "daily" => Format::number_format($daily)]);
    }

    public function getPurchaseStat()
    {
        $janv = Purchase::query()->whereBetween('created_at', [now()->year . '-01-01', now()->year . '-01-31'])->sum('amount');
        $fev = Purchase::query()->whereBetween('created_at', [now()->year . '-02-01', now()->year . '-02-28'])->sum('amount');
        $mars = Purchase::query()->whereBetween('created_at', [now()->year . '-03-01', now()->year . '-03-31'])->sum('amount');
        $avr = Purchase::query()->whereBetween('created_at', [now()->year . '-04-01', now()->year . '-04-30'])->sum('amount');
        $mai = Purchase::query()->whereBetween('created_at', [now()->year . '-05-01', now()->year . '-05-31'])->sum('amount');
        $juin = Purchase::query()->whereBetween('created_at', [now()->year . '-06-01', now()->year . '-06-30'])->sum('amount');
        $jul = Purchase::query()->whereBetween('created_at', [now()->year . '-07-01', now()->year . '-07-31'])->sum('amount');
        $aout = Purchase::query()->whereBetween('created_at', [now()->year . '-08-01', now()->year . '-08-31'])->sum('amount');
        $sept = Purchase::query()->whereBetween('created_at', [now()->year . '-09-01', now()->year . '-09-30'])->sum('amount');
        $oct = Purchase::query()->whereBetween('created_at', [now()->year . '-10-01', now()->year . '-10-31'])->sum('amount');
        $nov = Purchase::query()->whereBetween('created_at', [now()->year . '-11-01', now()->year . '-11-30'])->sum('amount');
        $dec = Purchase::query()->whereBetween('created_at', [now()->year . '-12-01', now()->year . '-12-31'])->sum('amount');

        $total = $janv + $fev + $mars + $avr + $mai + $juin + $jul + $aout + $sept + $oct + $nov + $dec;

        return response()->json(["data" => [$janv, $fev, $mars, $avr, $mai, $juin, $jul, $aout, $sept, $oct, $nov, $dec], "sum" => Format::number_format($total)]);
    }

    public function getBalance()
    {
        $janv = Bank::query()->whereBetween('created_at', [now()->year . '-01-01', now()->year . '-01-31'])->sum('amount');
        $fev = Bank::query()->whereBetween('created_at', [now()->year . '-02-01', now()->year . '-02-28'])->sum('amount');
        $mars = Bank::query()->whereBetween('created_at', [now()->year . '-03-01', now()->year . '-03-31'])->sum('amount');
        $avr = Bank::query()->whereBetween('created_at', [now()->year . '-04-01', now()->year . '-04-30'])->sum('amount');
        $mai = Bank::query()->whereBetween('created_at', [now()->year . '-05-01', now()->year . '-05-31'])->sum('amount');
        $juin = Bank::query()->whereBetween('created_at', [now()->year . '-06-01', now()->year . '-06-30'])->sum('amount');
        $jul = Bank::query()->whereBetween('created_at', [now()->year . '-07-01', now()->year . '-07-31'])->sum('amount');
        $aout = Bank::query()->whereBetween('created_at', [now()->year . '-08-01', now()->year . '-08-31'])->sum('amount');
        $sept = Bank::query()->whereBetween('created_at', [now()->year . '-09-01', now()->year . '-09-30'])->sum('amount');
        $oct = Bank::query()->whereBetween('created_at', [now()->year . '-10-01', now()->year . '-10-31'])->sum('amount');
        $nov = Bank::query()->whereBetween('created_at', [now()->year . '-11-01', now()->year . '-11-30'])->sum('amount');
        $dec = Bank::query()->whereBetween('created_at', [now()->year . '-12-01', now()->year . '-12-31'])->sum('amount');

        $total = $janv + $fev + $mars + $avr + $mai + $juin + $jul + $aout + $sept + $oct + $nov + $dec;

        return response()->json([
            "data" => [$janv, $fev, $mars, $avr, $mai, $juin, $jul, $aout, $sept, $oct, $nov, $dec],
            "sum" => Format::number_format($total),
            "class" => $total < 0 ? "danger" : ($total > 0 ? "success" : "info")
        ]);
    }

    public function addSale(Request $request)
    {
        //dd($request->all());
        try {
            $sale = Sale::create([
                "reference" => $request->get('reference'),
                "designation" => $request->get('designation'),
                "amount" => $request->get('amount'),
                "created_at" => $request->get('created_at')
            ]);

            try {
                Bank::create([
                    "reference" => $sale->reference,
                    "designation" => $sale->designation,
                    "amount" => $sale->amount,
                    "created_at" => $sale->created_at,
                    "paypal_id" => $request->get('paypal_id') ? $request->get('paypal_id') : null,
                    "model_type" => "sale",
                    "model_id" => $sale->id
                ]);

                ob_start();
                ?>
                <tr>
                    <td><?= $sale->created_at->format("Y-m-d"); ?></td>
                    <td>
                        <strong><?= $sale->designation; ?></strong><br>
                        <?php if($sale->reference): ?> <span class="text-muted">R??f??rence: <?= $sale->reference; ?></span> <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <?= \App\Helpers\Format::number_format($sale->amount) ?>
                    </td>
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                            <span class="svg-icon svg-icon-5 m-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
								</svg>
							</span>
                            <!--end::Svg Icon--></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="../../demo1/dist/apps/subscriptions/add.html" class="menu-link px-3 editSale" data-id="<?= $sale->id ?>">Editer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" data-kt-subscriptions-table-filter="delete_row" class="menu-link text-danger px-3 delSale" data-id="<? $sale->id ?>">Supprimer</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                </tr>
                <?php
                LogActivity::addToLog("Ajout d'une vente de <strong>" . Format::number_format($sale->amount) . "</strong> pour <strong>" . $sale->designation . "</strong>.");
                return response()->json(["sale" => $sale, "content" => ob_get_clean()]);
            } catch (\Exception $exception) {
                LogActivity::addToLog($exception->getMessage());
                Log::error($exception->getMessage());
                return response()->json($exception->getMessage(), 500);
            }
        } catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            Log::error($exception->getMessage());
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function getSale($sale_id)
    {
        $sale = Sale::query()->find($sale_id);

        $array = [
            "id" => $sale->id,
            "designation" => $sale->designation,
            "reference" => $sale->reference,
            "amount" => $sale->amount,
            "created_at" => $sale->created_at->format('Y-m-d')
        ];

        return response()->json($array);
    }

    public function updateSale(Request $request, $sale_id)
    {
        try {
            $sale = Sale::query()->find($sale_id);
            $sale->update($request->all());

            try {
                $bank = Bank::query()->where('model_type', 'sale')
                    ->where('model_id', $sale_id)
                    ->first();

                $bank->update([
                    "reference" => $sale->reference,
                    "designation" => "Incoming: ".$sale->designation,
                    "amount" => "-".$sale->amount,
                    "created_at" => $sale->created_at,
                    "paypal_id" => $request->get('paypal_id') ? $request->get('paypal_id') : null,
                    "model_type" => "sale",
                    "model_id" => $sale->id
                ]);
                ob_start();
                ?>
                <tr>
                    <td><?= $sale->created_at->format("Y-m-d"); ?></td>
                    <td>
                        <strong><?= $sale->designation; ?></strong><br>
                        <?php if($sale->reference): ?> <span class="text-muted">R??f??rence: <?= $sale->reference; ?></span> <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <?= \App\Helpers\Format::number_format($sale->amount) ?>
                    </td>
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                            <span class="svg-icon svg-icon-5 m-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
								</svg>
							</span>
                            <!--end::Svg Icon--></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="../../demo1/dist/apps/subscriptions/add.html" class="menu-link px-3 editSale" data-id="<?= $sale->id ?>">Editer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" data-kt-subscriptions-table-filter="delete_row" class="menu-link text-danger px-3 delSale" data-id="<? $sale->id ?>">Supprimer</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                </tr>
                <script type="text/javascript">
                    let modal_edit_sale = $("#edit_sale")
                    let t = document.getElementById('table_sales')
                    $("#formEditSale").on('submit', e => {
                        e.preventDefault()
                        let form = $("#formEditSale")
                        let id = form.find('.idField').val()
                        let uri = '/api/back/accounting/sale/'+id
                        let btn = form.find('.btn-primary')
                        let data = form.serializeArray()

                        btn.attr('data-kt-indicator', 'on')

                        $.ajax({
                            url: uri,
                            method: "PUT",
                            data: data,
                            success: data => {
                                btn.removeAttr('data-kt-indicator')
                                btn.prepend('tr').fadeOut()
                                t.querySelector('tbody').innerHTML += data.content
                                modal_edit_sale.modal('hide')
                                toastr.success("Ventes Modifier avec Succ??s")
                                getSolde()
                            },
                            error: err => {
                                btn.removeAttr('data-kt-indicator')
                                console.error(err)
                            }
                        })
                    })
                </script>
                <?php
                LogActivity::addToLog("Edition de la vente <strong>".$sale->designation."</strong> d'un montant de <strong>".Format::number_format($sale->amount)."</strong>");
                return response()->json(["sale" => $sale, "content" => ob_get_clean()]);
            }catch (\Exception $exception) {
                LogActivity::addToLog($exception->getMessage());
                Log::error($exception->getMessage());
                return response()->json($exception->getMessage(), 500);
            }
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            Log::error($exception->getMessage());
            return response()->json($exception->getMessage(), 500);
        }
    }

    //---------------------------------------//

    public function addPurchase(Request $request)
    {
        //dd($request->all());
        try {
            $sale = Purchase::create([
                "reference" => $request->get('reference'),
                "designation" => $request->get('designation'),
                "amount" => $request->get('amount'),
                "created_at" => $request->get('created_at')
            ]);

            try {
                Bank::create([
                    "reference" => $sale->reference,
                    "designation" => "Outgoing: ".$sale->designation,
                    "amount" => "-".$sale->amount,
                    "created_at" => $sale->created_at,
                    "paypal_id" => $request->get('paypal_id') ? $request->get('paypal_id') : null,
                    "model_type" => "purchase",
                    "model_id" => $sale->id
                ]);

                ob_start();
                ?>
                <tr>
                    <td><?= $sale->created_at->format("Y-m-d"); ?></td>
                    <td>
                        <strong><?= $sale->designation; ?></strong><br>
                        <?php if($sale->reference): ?> <span class="text-muted">R??f??rence: <?= $sale->reference; ?></span> <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <?= \App\Helpers\Format::number_format($sale->amount) ?>
                    </td>
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                            <span class="svg-icon svg-icon-5 m-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
								</svg>
							</span>
                            <!--end::Svg Icon--></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="../../demo1/dist/apps/subscriptions/add.html" class="menu-link px-3 editPurchase" data-id="<?= $sale->id ?>">Editer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" data-kt-subscriptions-table-filter="delete_row" class="menu-link text-danger px-3 delPurchase" data-id="<? $sale->id ?>">Supprimer</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                </tr>
                <?php
                LogActivity::addToLog("Ajout d'un Achat de <strong>" . Format::number_format($sale->amount) . "</strong> pour <strong>" . $sale->designation . "</strong>.");
                return response()->json(["sale" => $sale, "content" => ob_get_clean()]);
            } catch (\Exception $exception) {
                LogActivity::addToLog($exception->getMessage());
                Log::error($exception->getMessage());
                return response()->json($exception->getMessage(), 500);
            }
        } catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            Log::error($exception->getMessage());
            return response()->json($exception->getMessage(), 500);
        }
    }

    public function getPurchase($purchase_id)
    {
        $sale = Purchase::query()->find($purchase_id);

        $array = [
            "id" => $sale->id,
            "designation" => $sale->designation,
            "reference" => $sale->reference,
            "amount" => $sale->amount,
            "created_at" => $sale->created_at->format('Y-m-d')
        ];

        return response()->json($array);
    }

    public function updatePurchase(Request $request, $purchase_id)
    {
        try {
            $sale = Purchase::query()->find($purchase_id);
            $sale->update($request->all());

            try {
                $bank = Bank::query()->where('model_type', 'purchase')
                    ->where('model_id', $purchase_id)
                    ->first();

                $bank->update([
                    "reference" => $sale->reference,
                    "designation" => "Outgoing: ".$sale->designation,
                    "amount" => "-".$sale->amount,
                    "created_at" => $sale->created_at,
                    "paypal_id" => $request->get('paypal_id') ? $request->get('paypal_id') : null,
                    "model_type" => "purchase",
                    "model_id" => $sale->id
                ]);
                ob_start();
                ?>
                <tr>
                    <td><?= $sale->created_at->format("Y-m-d"); ?></td>
                    <td>
                        <strong><?= $sale->designation; ?></strong><br>
                        <?php if($sale->reference): ?> <span class="text-muted">R??f??rence: <?= $sale->reference; ?></span> <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <?= \App\Helpers\Format::number_format($sale->amount) ?>
                    </td>
                    <td class="text-end">
                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                            <span class="svg-icon svg-icon-5 m-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
								</svg>
							</span>
                            <!--end::Svg Icon--></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="../../demo1/dist/apps/subscriptions/add.html" class="menu-link px-3 editPurchase" data-id="<?= $sale->id ?>">Editer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" data-kt-subscriptions-table-filter="delete_row" class="menu-link text-danger px-3 delPurchase" data-id="<? $sale->id ?>">Supprimer</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                    </td>
                </tr>
                <script type="text/javascript">
                    let modal_edit_purchase = $("#edit_purchase")
                    let t = document.getElementById('table_purchases')
                    $("#formEditPurchase").on('submit', e => {
                        e.preventDefault()
                        let form = $("#formEditPurchase")
                        let id = form.find('.idField').val()
                        let uri = '/api/back/accounting/purchase/'+id
                        let btn = form.find('.btn-primary')
                        let data = form.serializeArray()

                        btn.attr('data-kt-indicator', 'on')

                        $.ajax({
                            url: uri,
                            method: "PUT",
                            data: data,
                            success: data => {
                                btn.removeAttr('data-kt-indicator')
                                btn.prepend('tr').fadeOut()
                                t.querySelector('tbody').innerHTML += data.content
                                modal_edit_sale.modal('hide')
                                toastr.success("Achat Modifier avec Succ??s")
                                getSolde()
                            },
                            error: err => {
                                btn.removeAttr('data-kt-indicator')
                                console.error(err)
                            }
                        })
                    })
                </script>
                <?php
                LogActivity::addToLog("Edition de l'achat <strong>".$sale->designation."</strong> d'un montant de <strong>".Format::number_format($sale->amount)."</strong>");
                return response()->json(["sale" => $sale, "content" => ob_get_clean()]);
            }catch (\Exception $exception) {
                LogActivity::addToLog($exception->getMessage());
                Log::error($exception->getMessage());
                return response()->json($exception->getMessage(), 500);
            }
        }catch (\Exception $exception) {
            LogActivity::addToLog($exception->getMessage());
            Log::error($exception->getMessage());
            return response()->json($exception->getMessage(), 500);
        }
    }

    //--------------------------------------//

    public function addBank(Request $request)
    {
        //dd($request->all());
        if($request->get('model_type') == 'sale') {
            $this->addSale($request);
        } else {
            $this->addPurchase($request);
        }
    }

    public function getBank($bank_id)
    {
        $sale = Bank::query()->find($bank_id);

        $array = [
            "id" => $sale->id,
            "designation" => $sale->designation,
            "reference" => $sale->reference,
            "amount" => $sale->amount,
            "paypal_id" => $sale->paypal_id,
            "model_type" => $sale->model_type,
            "model_id" => $sale->model_id,
            "created_at" => $sale->created_at->format('Y-m-d')
        ];

        return response()->json($array);
    }

    public function updateBank(Request $request, $bank_id)
    {
        $bank = Bank::query()->find($bank_id);

        if($request->get('model_type') == 'sale') {
            $this->updateSale($request, $bank->model_id);
        } else {
            $this->updatePurchase($request, $bank->model_id);
        }
    }
}
