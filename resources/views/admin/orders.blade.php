@extends('layouts.admin')
@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col card">
                <div class="card-header">
                    <h2 class="page-title">
                        Orders
                    </h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter table-mobile-md card-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order #</th>
                                    <th>User Name</th>
                                    <th>user Email</th>
                                    <th>Order Price</th>
                                    {{-- <th>Discount On Order</th> --}}
                                    <th>Order Date</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter1 = 0; ?>
                                @foreach($orders as $key => $order)
                                <?php $counter1++; ?>
                                <tr>
                                    <th scope="row">{{++$key}}</th>
                                    <td class="pl-0">00000{{@$order->id}}</td>
                                    <td class="pl-0">{{@$order->student->name}}</td>
                                    <td class="pl-0">{{@$order->student->email}}</td>
                                    <td class="pl-0">${{@$order->amount}}</td>
                                    {{-- <td class="pl-0">@if(!empty($order->discount)) ${{@$order->discount}} @else $0 @endif</td> --}}
                                    <td class="pl-0">{{@$order->created_at}}</td>
                                    {{-- <td class="pl-0"><a class="btn btn-success" href="{{url('admin/orders/invoice', @$order->id)}}">Invoice</a></td> --}}
                                </tr>
                                @endforeach
                                @if($counter1 == 0)
                                <h2 class="mx-auto my-0">No Orders yet</h2>
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection