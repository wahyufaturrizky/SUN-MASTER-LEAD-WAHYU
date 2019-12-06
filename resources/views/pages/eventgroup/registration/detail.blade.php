@extends('layouts.backend')

@section('css_after')
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        {{-- <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-0">Leads</h2>
            <h3 class="h5 text-muted mb-0">Welcome to your app.</h3>
        </div> --}}
        <div class="row">
            <div class="col-md-12">
                <!-- Static Labels -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">{{ $lead->full_name }} ({{ $lead->register_id }})</h3>
                        <div class="block-options hide d-none">
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        @include('pages.event.partials.form.leadsDisabled')
                        <hr>
                        <a href="{{ route('detailEventGroup', $event_group_id) }}" class="btn btn-sm btn-alt-secondary mx-1 mb-5 pb-5" data-toggle="tooltip" title="View"><i class="si si-arrow-left"></i> Back</a>
                    </div>
                </div>
                <!-- END Static Labels -->
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
