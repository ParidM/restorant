@extends('layouts.app')

@section('title')
    <title>Seragam Barcode</title>
@endsection

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-wallet icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Transaksi
                    <div class="page-title-subheading">
                        melakukan transaksi pelanggan
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <a class="btn btn-danger" href="#"><i class="metismenu-icon pe-7s-back"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-md-8">
                                <select name="" class="form-control" id="">
                                    <option value="">-- Silahkan Pilih Nama Pelanggan --</option>
                                </select>
                                <select name="" class="form-control mt-2" id="">
                                    <option value="">-- Silahkan Pilih Produk --</option>
                                </select>
                                <table id="myTable2" class="table table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="4" class="text-center">Belum ada data yang dipilih</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <form action="#" method="post">
                                    @csrf 
                                    <div class="row mt-2">
                                        <div class="col">Total:</div>
                                        <div class="col text-right">
                                            <input type="number" value="" name="total" readonly class="form-control total">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">Diterima:</div>
                                        <div class="col text-right">
                                            <input type="number" value="" name="accept" class="form-control received">
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col">Kembali:</div>
                                        <div class="col text-right"> 
                                            <input type="number" value="" name="return" readonly class="form-control return">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button
                                                type="button"
                                                class="btn btn-danger btn-block"
                                            >
                                                Cancel
                                            </button>
                                        </div>
                                        <div class="col">
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-block"
                                            >
                                                Pay
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>    
    </div>
</div>
<script>
         $(document).ready(function() {

                function getCarts(){
                $.ajax({
                    type: 'get',
                    url: "cart",
                    dataType: "json",
                    success: function(response) {
                        let total = 0;
                        $('tbody').html("");
                        $.each(response.carts, function(key,product) {
                            total += product.price * product.quantity                            
                            $('tbody').append(`
                            <tr>
                                <td>${product.name}</td>
                                <td class="d-flex">
                                    <select class="form-control qty">
                                    ${[...Array(product.stock).keys()].map((x) => (
                                        `<option ${product.quantity == x + 1 ? 'selected' : null} value=${x + 1}>
                                            ${x + 1}
                                        </option>`
                                    ))}
                                    </select>
                                    <input
                                        type="hidden"
                                        class="cartId"
                                        value="${product.id}"
                                        />
                                    <button
                                        type="button"
                                        class="btn btn-danger btn-sm delete"
                                        value="${product.id}"
                                        
                                    >
                                    <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                                <td class="text-right">
                                $${ product.quantity * product.price}
                                </td>
                            </tr>
                            `)
                        });

                        const test = $('.total').attr('value', `${total}`);
                    }
                })
            }

            getCarts()

            $(document).on('change', '.received', function() {
                const received = $(this).val();
                const total = $('.total').val();
                const subTotal = received - total;
                const change = $('.return').val(subTotal);            
            })

            $(document).on('change', '.qty', function() {
                const qty = $(this).val();
                const cartId = $(this).closest('td').find('.cartId').val();
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax({
                    type: 'put',
                    url: `carts/${cartId}`,
                    data: {
                        qty
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response.status === 400){
                            alert(response.message);
                        }
                        getCarts()
                    }
                })
            })

            $(document).on('keyup', '.search', function() {
                const search = $(this).val();

                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                $.ajax({
                    type: 'post',
                    url: `products/search`,
                    data: {
                        search
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('.product-search').html("");
                        $.each(response, function(key,product) {                      
                            $('.product-search').append(`
                            <button type="button"
                                class="item"
                                style="cursor: pointer; border: none;"
                                value="${product.id}"
                            >
                                <img src="http://127.0.0.1:8000/storage/${product.image.id}/${product.image.file_name}" width="45px" height="45px" alt="test" />
                               
                                <h6 style="margin: 0;">${product.name}</h6>
                                <span >(${product.price})</span>
                            </button>
                            `)
                        });
                    }
                })
            })

            $(document).on('click', '.delete', function() {
                const cartId = $(this).val();
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'delete',
                    url: `carts/${cartId}`,
                    success: function(response) {
                        if(response.status === 400){
                            alert(response.message);
                        }
                        getCarts()
                    }
                })
            })

            $('.scan').click(function(e) {
                e.preventDefault();
                const productCode = $(this).closest('form').find('.productCode').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'post',
                    url: `carts`,
                    data: {
                        productCode
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response.status === 400 || response.status === 500){
                            alert(response.message);
                        }
                        getCarts()
                    }
                })
            });

            $(document).on('click', '.item', function() {
                const productId = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'post',
                    url: `carts`,
                    data: {
                        productId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if(response.status === 400){
                            alert(response.message);
                        }
                        getCarts()
                    }
                })

            })
         })
    </script>   
@endsection