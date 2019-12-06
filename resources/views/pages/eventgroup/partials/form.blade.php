<div class="form-group row {{ $errors->has('event_group_name') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
        <input value="{{ isset($eventGroup) ? $eventGroup->event_group_name : ''}}" type="text" class="form-control" id="event_group_name" name="event_group_name" placeholder="Please enter event group name" required autofocus autocomplete="off" @isset($disabled) disabled="{{ $disabled }}" @endisset>
            <label for="event_group_name">Group Name</label>
            @if ($errors->has('event_group_name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('event_group_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('event_ids') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="event_ids" name="event_ids[]" style="width: 100%;" data-placeholder="Choose one.." multiple required @isset($disabled) disabled="{{ $disabled }}" @endisset>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach($events as $event)
                    <option value="{{ $event->event_id }}">{{ $event->event_name }}</option>
                @endforeach
            </select>
            <label for="event_ids">Events</label>
            @if ($errors->has('event_ids'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('event_ids') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-12">
        <div class="form-material">
            <label>Event Close (if blank, event will be close automatically at h-1)</label>
            <input type="text" id="date" name="event_close" value="{{ isset($eventGroup) ? $eventGroup->event_close : '' }}" placeholder="Please enter date" class="js-flatpickr form-control" autocomplete="off" data-allow-input="false" data-enable-time="true" data-min-date="{{ Carbon\Carbon::now()->subDay()->format('Y-m-d') }}" data-time_24hr="true" {{ isset($disabled) ? 'disabled="disabled"' : '' }} required/>
        </div>
    </div>
</div>

@section('css_before')
    <link rel="stylesheet" href="{{ asset('/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
<script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script>jQuery(function(){ Codebase.helpers(['flatpickr','select2',]); });</script>
    <script type="text/javascript">
        @if(isset($eventGroup))
            $(document).ready(function(){
                var event_ids = {!! $eventGroup->arrEvent() !!};
                $('#event_ids').val(event_ids).trigger('change');
            });
        @endif
    </script>
@endsection
