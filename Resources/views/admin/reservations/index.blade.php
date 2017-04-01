@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('carrental::reservations.title.reservations') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('carrental::reservations.title.reservations') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.carrental.reservation.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('carrental::reservations.button.create reservation') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                    <table class="data-table table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>{{ trans('carrental::cars.title.car') }}</th>
                            <th>{{ trans('carrental::reservations.title.fullname') }}</th>
                            <th>{{ trans('carrental::reservations.title.daily_price') }}</th>
                            <th>{{ trans('carrental::reservations.title.total_day') }}</th>
                            <th>{{ trans('carrental::reservations.title.total_price') }}</th>
                            <th>{{ trans('core::core.table.created at') }}</th>
                            <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($reservations)): ?>
                        <?php foreach ($reservations as $reservation): ?>
                        <tr>
                            <th>
                                {{ $reservation->id }}
                            </th>
                            <td>
                                <a href="{{ route('admin.carrental.reservation.edit', [$reservation->id]) }}">
                                    {{ isset($reservation->car->fullname) ? $reservation->car->fullname : '' }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.carrental.reservation.edit', [$reservation->id]) }}">
                                    {{ $reservation->fullname }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.carrental.reservation.edit', [$reservation->id]) }}">
                                    {{ $reservation->present()->daily_price }} TL
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.carrental.reservation.edit', [$reservation->id]) }}">
                                    {{ $reservation->total_day }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.carrental.reservation.edit', [$reservation->id]) }}">
                                    {{ $reservation->present()->total_price }} TL
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.carrental.reservation.edit', [$reservation->id]) }}">
                                    {{ $reservation->created_at }}
                                </a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.carrental.reservation.edit', [$reservation->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                    <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.carrental.reservation.destroy', [$reservation->id]) }}"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('carrental::reservations.title.create reservation') }}</dd>
    </dl>
@stop

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.carrental.reservation.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@stop
