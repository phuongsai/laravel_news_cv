@extends('layouts.backend.app')

@section('title','Subscribers')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('assets/backend/vendor/datatables/dataTables.bootstrap4.min.css') }}"
    rel="stylesheet">
@endpush

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">ALL SUBSCRIBERS</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">SUBSCRIBERS
            <span class="badge badge-primary">{{ $subscribers->count() }}</span>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @forelse($subscribers as $key => $subscriber)
                    <tr class="text-center">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $subscriber->email }}</td>
                        <td>{{ $subscriber->created_at }}</td>
                        <td>{{ $subscriber->updated_at }}</td>
                        @if($subscriber->deleted_at == null)
                        <td>
                            <span class="badge badge-pill badge-primary">Active</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger" type="button"
                                onclick="deleteSubscriber({{ $subscriber->id }})">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                            <form id="delete-form-{{ $subscriber->id }}"
                                action="{{ route('admin.subscriber.destroy', $subscriber->id) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                        @else
                        <td>
                            <span class="badge badge-pill badge-danger">Inactive</span>
                        </td>
                        <td>
                            <button class="btn btn-warning" type="button"
                                onclick="restoreSubscriber({{ $subscriber->id }})">
                                <i class="fa fa-undo" aria-hidden="true"></i>
                            </button>
                            <form id="restore-form-{{ $subscriber->id }}"
                                action="{{ route('admin.subscriber.restore',$subscriber->id) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                        </td>
                        @endif
                    </tr>
                    @empty
                        <p>No data!</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


@push('js')
@include('layouts.backend.partials.dataTable')
<script type="text/javascript">
    function deleteSubscriber(id) {
        confirmSubmit('delete', id);
        }
    function restoreSubscriber(id) {
        confirmSubmit('restore', id);
    }
</script>
@endpush