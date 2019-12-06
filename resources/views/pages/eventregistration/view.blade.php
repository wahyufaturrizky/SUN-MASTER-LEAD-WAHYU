@extends('layouts.backend')

{{--  @section('css_after')
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
@endsection  --}}

@section('content')
    <!-- Page Content -->
    <div class="content">
        {{-- <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Leads</h2>
            <h3 class="h5 text-muted mb-0">Welcome to your app.</h3>
        </div> --}}

        <!-- Partial Table -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Students List</h3>
                <div class="block-options hide d-none">
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                </div>
            </div>
            <div class="block-content">
                <!-- <p>The second way is to use <a href="be_ui_grid.html#cb-grid-rutil">responsive utility CSS classes</a> for hiding columns in various screen resolutions. This way you can hide less important columns and keep the most valuable on smaller screens. At the following example the <strong>Access</strong> column isn't visible on small and extra small screens and <strong>Email</strong> column isn't visible on extra small screens.</p> -->
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">Nr.</th>
                            <th>Name</th>
                            <th class="d-none d-sm-table-cell">Email</th>
                            <th>Mobile Phone</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach($events as $i => $event)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td class="font-w600">{{ $event->studentName }}</td>
                            <td class="d-none d-sm-table-cell">{{ $event->email }}</td>
                            <td class="d-none d-sm-table-cell">{{ $event->mobilePhone }}</td>
                            <td class="d-none d-sm-table-cell"><a href="{{ route('viewDetails', [$event->id]) }}" class="btn btn-alt-primary"> > </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center text-center">
            <div class="col-md-auto">
                <div class="block">
                    <div class="block-content">
                        {{-- {{ $forms->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row justify-content-center">
            <div class="col-md-6 col-xl-5">
                <div class="block">
                    <div class="block-content">
                        <p class="font-size-sm text-muted">
                            We’ve put everything together, so you can start working on your Laravel project as soon as possible! Codebase assets are integrated and work seamlessly with Laravel Mix, so you can use the npm scripts as you would in any other Laravel project.
                        </p>
                        <p class="font-size-sm text-muted">
                            Feel free to use any examples you like from the full versions to build your own pages. <strong>Wish you all the best and happy coding!</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')
    <!-- url slug generator -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>
    <script src="{{ asset('vendor/leocaseiro/jquery.stringtoslug.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready( function() {
            $("#material-form-name").stringToSlug();
        });
    </script>
@endsection