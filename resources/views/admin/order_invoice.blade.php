@extends('layouts.admin')
<title>
    Order Invoice</title>
@section('content')
    <div class="container m-100">
        <!-- Page title -->
        <div class="container">
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <!-- Page title actions -->
                    <div class="col-auto ml-5" style="margin-left: 990px;">
                        <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                <rect x="7" y="13" width="10" height="8" rx="2" />
                            </svg>
                            Print Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 w-100">
        <div style="height: 100%; display: table; margin:auto; background-color: #d5d5d5">
            <table style="width: 1000px; min-width: 1000px; max-width: 1000px;" border="0" cellspacing="0"
                cellpadding="0">
                <thead style="background-color: #bb9ffc87;">
                    <tr>
                        <td style="text-align: left; padding: 20px;">
                            <img src="{{ asset('assets/images/logo.png') }}" style="height: 70px;">
                        </td>
                        <td style="text-align: right; color:#000000; font-family: Halvetica, sans-serif; padding: 20px;">
                            <h2 style="font-size:14px;margin:0px;">Pulse Trainings</h2>
                            <div style="font-size: 12px;">70-80 Upper St Norwich NR2</div>
                            <div style="font-size: 12px;">+01 123 5641 231</div>
                            <div style="font-size: 12px;">
                                <a href="mailto:info@pulsetrainings.com"
                                    style="color:#000000; text-decoration:none">info@pulse-lms.com</a>
                            </div>
                        </td>
                    </tr>
                </thead>
                <tbody style="background-color: #ffffff;">
                    <tr>
                        <td style="padding: 20px">
                            <div style="margin-top: 20px;"></div>
                            <div
                                style="border-left: solid 6px #bb9ffc87; font-size:14px; color:rgb(23,58,60); font-family: Halvetica, sans-serif; padding-left: 10px;">
                                <div style="font-size: 14px;">INVOICE TO:</div>
                                {{-- @dd($order_invoice['student']) --}}
                                <h2 style="font-size: 18px;font-weight:normal;margin:0px;">
                                    {{ $order_invoice['student']['name'] }}</h2>
                                <div>
                                    <a href="mailto:{{ $order_invoice['student']['email'] }}"
                                        style="font-size: 14px; color:rgb(23,58,60); text-decoration:none">{{ $order_invoice['student']['email'] }}</a>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 20px;">
                            <div style="margin-top: 20px;"></div>
                            <div
                                style="border-right: solid 6px #bb9ffc87; text-align:right; color:rgb(23,58,60); font-size: 14px; font-family: Halvetica, sans-serif; padding-right: 10px;">
                                <h1 style="font-size:16px;line-height:1em;font-weight:normal;">INVOICE
                                    #00000{{ $order_invoice->id }}</h1>
                                <div> Date: {{ $order_invoice->created_at->format('Y-m-d') }}</div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div
                style="width: 1000px; min-width: 1000px; max-width: 1000px; display: block; margin: auto; background-color: #ffffff; padding-top: 30px; font-family: Halvetica, sans-serif; color:rgb(23,58,60);">
                @if (!empty($order_invoice->gap_analysis_id))
                    <table align="center" style="width: 950px;" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr style="font-size: 14px;">
                                <td
                                    style="padding: 15px; background-color: #dad7ff; text-align: center; font-size: 16px; border-bottom: 2px solid #ffffff;">
                                    #</td>
                                <td
                                    style="padding: 15px; width: 400px; background-color: #c5c3e3; text-align: center; border-bottom: 2px solid #ffffff;">
                                    Title</td>
                                <td
                                    style="padding: 15px; width: 400px; background-color: #dad7ff; text-align: center; border-bottom: 2px solid #ffffff;">
                                    Type</td>
                                <td
                                    style="padding: 15px; background-color: #c5c3e3; text-align: center; border-bottom: 2px solid #ffffff;">
                                    Discount Amount</td>
                                <td
                                    style="padding: 15px; background-color: #dad7ff; text-align: center; border-bottom: 2px solid #ffffff;">
                                    TOTAL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="font-size: 14px; border-bottom: 2px solid #ffff;">
                                <td style="padding: 15px; background-color: #dad7ff; text-align: center; font-size: 16px;">1
                                </td>
                                <td style="padding: 15px; width: 400px; background-color: #c5c3e3; text-align: center;">
                                    {{ $order_invoice->GapAnalysis->title }}</td>
                                <td style="padding: 15px; width: 400px; background-color: #dad7ff; text-align: center;">
                                    @if ($order_invoice->type == 'medical_rep')
                                        Medical Rep
                                    @else
                                        Leader
                                    @endif
                                </td>
                                <td style="padding: 15px; background-color: #c5c3e3; text-align: center;">
                                    @if (!empty($order_invoice->discount_amount))
                                        $ {{ $order_invoice->discount_amount }}
                                    @else
                                        $ 0
                                    @endif
                                </td>
                                <td
                                    style="padding: 15px; background-color: #dad7ff; text-align: center; border-bottom: 2px solid #ffffff;">
                                    $ @if ($order_invoice->type == 'leader')
                                        {{ $order_invoice->GapAnalysis->leader_price }}
                                    @else
                                        {{ $order_invoice->GapAnalysis->medical_rep_price }}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="padding: 15px;"></td>
                                <td colspan="2"
                                    style="padding: 15px; text-align: right; border-bottom: 1px solid rgb(23,58,60); font-size: 14px;">
                                    <strong>Discount</strong></td>
                                <td
                                    style="padding: 15px; text-align: right; border-bottom: 1px solid rgb(23,58,60); font-size: 14px;">
                                    @if (!empty($order_invoice->discount))
                                        $ {{ $order_invoice->discount }}
                                    @else
                                        $ 0
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 15px;"></td>
                                <td colspan="2"
                                    style="padding: 15px; text-align: right; border-bottom: 1px solid rgb(23,58,60); font-size: 14px;">
                                    <strong>Subtotal</strong></td>
                                <td
                                    style="padding: 15px; text-align: right; border-bottom: 1px solid rgb(23,58,60); font-size: 14px;">
                                    $ {{ $order_invoice->amount - $order_invoice->discount }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 15px;"></td>
                                <td colspan="2" style="padding: 15px; text-align: right; font-size: 16px;"><strong>Grand
                                        Total</strong></td>
                                <td style="padding: 15px; text-align: right; font-size: 16px;">$
                                    {{ @$data['amount'] - @$data['discount'] }}</td>
                            </tr>
                        </tfoot>
                    </table>
                @else
                    <table align="center" style="width: 950px;" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr style="font-size: 14px;">
                                <td
                                    style="padding: 15px; background-color: #dad7ff; text-align: center; font-size: 16px; border-bottom: 2px solid #ffffff;">
                                    #</td>
                                <td
                                    style="padding: 15px; width: 400px; background-color: #c5c3e3; text-align: center; border-bottom: 2px solid #ffffff;">
                                    Course NAME</td>
                                <td
                                    style="padding: 15px; width: 400px; background-color: #dad7ff; text-align: center; border-bottom: 2px solid #ffffff;">
                                    Training Type</td>
                                <td
                                    style="padding: 15px; background-color: #c5c3e3; text-align: center; border-bottom: 2px solid #ffffff;">
                                    Quantity</td>
                                <td
                                    style="padding: 15px; background-color: #dad7ff; text-align: center; border-bottom: 2px solid #ffffff;">
                                    TOTAL</td>
                            </tr>
                        </thead>

                        @if (count($order_invoice->orderitems) > 0)
                            <tbody>
                                @foreach ($order_invoice->orderitems as $key => $val)
                                    <tr style="font-size: 14px; border-bottom: 2px solid #ffff;">
                                        <td
                                            style="padding: 15px; background-color: #dad7ff; text-align: center; font-size: 16px;">
                                            {{ ++$key }}</td>
                                        <td
                                            style="padding: 15px; width: 400px; background-color: #c5c3e3; text-align: center;">
                                            {{ @$val->course->course_name }}</td>
                                        <td
                                            style="padding: 15px; width: 400px; background-color: #dad7ff; text-align: center;">
                                            @if (@$val->training_type == 'session')
                                                One-to-One Session
                                                <p class="my-0">
                                                    {{ date('d, M Y', strtotime(@$val->date)) . '  ' . date('h:i A', strtotime(@$val->start_time)) . ' - ' . date('h:i A', strtotime(@$val->end_time)) }}
                                                </p>
                                            @else
                                                Recorded Training
                                            @endif
                                        </td>
                                        <td style="padding: 15px; background-color: #c5c3e3; text-align: center;">x1</td>
                                        <td style="padding: 15px; background-color: #dad7ff; text-align: center;">$
                                            @if (@$val['training_type'] == 'session')
                                                {{ @$val['course']['session_price'] }}
                                            @else
                                                {{ $val->course->price }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                        <tfoot class="">
                            <tr class="" style="border-bottom: 1px solid #bbc2cb;">
                                <td colspan="2" style="padding: 15px;"></td>
                                <td colspan="2" style="padding: 15px; text-align: right; font-size: 14px;">
                                    <strong>Discount</strong></td>
                                <td style="padding: 15px; text-align: right; font-size: 14px;">
                                    @if (!empty($order_invoice->discount))
                                        $ {{ $order_invoice->discount }}
                                    @else
                                        $ 0
                                    @endif
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #bbc2cb;">
                                <td colspan="2" style="padding: 15px;"></td>
                                <td colspan="2" style="padding: 15px; text-align: right; font-size: 14px;">
                                    <strong>Subtotal</strong></td>
                                <td style="padding: 15px; text-align: right; font-size: 14px;">$
                                    {{ $order_invoice->amount - $order_invoice->discount }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 15px;"></td>
                                <td colspan="2" style="padding: 15px; text-align: right; font-size: 16px;">
                                    <strong>Grand Total</strong></td>
                                <td style="padding: 15px; text-align: right; font-size: 16px;">$
                                    {{ $order_invoice->amount - $order_invoice->discount }}</td>
                            </tr>
                        </tfoot>
                    </table>
                @endif
            </div>
            <table style="width: 1000px; min-width: 1000px; max-width: 1000px;" border="0" cellspacing="0"
                cellpadding="0">
                <tbody style="background-color: #ffffff;">
                    <tr>
                        <td style="padding: 20px;">
                            <div style="margin-top: 20px;"></div>
                            <div
                                style="border-left: solid 6px #bb9ffc87; font-size:14px; color:rgb(23,58,60); font-family: Halvetica, sans-serif; padding-left: 10px;">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
