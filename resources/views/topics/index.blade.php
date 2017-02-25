@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.topics.title')</h3>
@if(Auth::user()->isAdmin())
    <p>
        <a href="{{ route('topics.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>
@endif
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($topics) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('quickadmin.topics.fields.title')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($topics) > 0)
                        @foreach ($topics as $topic)
                            <tr data-entry-id="{{ $topic->id }}">
                                <td></td>
                                <td>{{ $topic->title }}</td>
                                <td>
                                    <a href="{{ route('tests.newtest',[$topic->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.test.new')</a>
                                    @if(Auth::user()->isAdmin())
                                    <a href="{{ route('topics.show',[$topic->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    <a href="{{ route('topics.edit',[$topic->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['topics.destroy', $topic->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                  @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
  @if(Auth::user()->isAdmin())
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('topics.mass_destroy') }}';
    </script>
    @endif
@endsection
