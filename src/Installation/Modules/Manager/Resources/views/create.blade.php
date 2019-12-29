@extends('layouts.main')
@section('title')
    Добавить продукт
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Добавить товар</h3>
        </div>
        @include('products.form',compact('model','discount'))
    </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="/plugins/timepicker/bootstrap-timepicker.css">
@endsection
@section('js-append')
    <script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="/plugins/datepicker/locales/bootstrap-datepicker.ru.js"></script>
    <script src="/plugins/timepicker/bootstrap-timepicker.js"></script>
    <script>
        $(document).ready(function() {
            $('#datepicker').datepicker({
                isRTL: false,
                format: 'yyyy-mm-dd',
                language: 'ru'
            });
        });
    </script>
@endsection