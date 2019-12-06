<div class="form-group row">
    <div class="col-12">
        <div class="form-material">
            <label for="event_name">Event Name</label>
            <input type="text" class="form-control" id="event_name" name="event_name" value="{{ isset($event) ? $event->event_name : '' }}" placeholder="Please enter form name" required="required" autocomplete="off" required {{ isset($disabled) ? 'disabled="disabled"' : '' }}>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-12">
        <div class="form-material">
            <label for="abbreviation">Abbreviation (Initial eg. JKT)</label>
            <input maxlength="3" minlength="3" type="text" class="form-control text-uppercase" id="abbreviation" name="abbreviation" value="{{ isset($event) ? $event->abbreviation : '' }}" required="required" autocomplete="off" required {{ isset($disabled) ? 'disabled="disabled"' : '' }}>
            {{-- placeholder="Please enter abbreviation (Initial 3 letters) eg. IET" --}}
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-12">
        <div class="form-material">
            <label for="event_type_id">Event Type</label>
            <select class="js-select2 form-control" name="event_type_id" value="{{ isset($event) ? $event->event_type_id : '' }}" id="category" required {{ isset($disabled) ? 'disabled="disabled"' : '' }}>
                <option value="" selected disabled>Select One</option>
                    @foreach($eventTypes as $eventType)
                        @isset($event)
                            @if($event->event_type_id == $eventType->event_type_id)
                                <option value="{{ $eventType->event_type_id }}" selected>{{ $eventType->event_type_name }}</option>
                            @else
                                <option value="{{ $eventType->event_type_id }}">{{ $eventType->event_type_name }}</option>
                            @endif
                        @else
                            <option value="{{ $eventType->event_type_id }}">{{ $eventType->event_type_name }}</option>
                        @endif
                    @endforeach
            </select>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-6">
        <div class="form-material">
            <label for="start_date">Date</label>
            <input type="text" id="date" name="start_date" value="{{ isset($event) ? $event->start_date : '' }}" placeholder="Please enter date" class="js-flatpickr form-control" data-min-date="{{ Carbon\Carbon::now()->subDay()->format('Y-m-d') }}" autocomplete="off" required {{ isset($disabled) ? 'disabled="disabled"' : '' }}/>
        </div>
    </div>
    <div class="col-3">
        <div class="form-material">
            <label for="end_time">Start Time</label>
            {{-- <input type="time" name="start_time" id="time" placeholder="Please enter time" class="form-control" autocomplete="off" /> --}}
            <input type="text" class="js-flatpickr form-control" id="start_time" name="start_time" value="{{ isset($event) ? $event->startTime() : '' }}" placeholder="00:00" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" data-time_24hr="true" required {{ isset($disabled) ? 'disabled="disabled"' : '' }}>
        </div>
    </div>
    <div class="col-3">
        <div class="form-material">
            <label for="end_time">End Time</label>
            {{-- <input type="time" name="start_time" id="time" placeholder="Please enter time" class="form-control" autocomplete="off" /> --}}
            <input type="text" class="js-flatpickr form-control" id="end_time" name="end_time" value="{{ isset($event) ? $event->endTime() : '' }}" placeholder="00:00" data-enable-time="true" data-no-calendar="true" data-date-format="H:i" data-time_24hr="true" required {{ isset($disabled) ? 'disabled="disabled"' : '' }}>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-12">
        <div class="form-material">
            <label for="location">Location</label>
            <textarea class="form-control" id="location" name="location" rows="3" placeholder="Please add a location" required {{ isset($disabled) ? 'disabled="disabled"' : '' }}>{{ isset($event) ? $event->location : '' }}</textarea>
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('branch_id') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="branch_id" value="{{ isset($event) ? $event->branch_id : ''}}" name="branch_id" style="width: 100%;" data-placeholder="Choose one.." required {{ isset($disabled) ? 'disabled="disabled"' : '' }}>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach($branches as $branch)
                    @isset($event)
                        @if($branch->branch_id == $event->branch_id)
                            <option value="{{ $branch->branch_id }}" selected>{{ $branch->branch_name }}</option>
                        @else
                            <option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}</option>
                        @endif
                    @else
                        <option value="{{ $branch->branch_id }}">{{ $branch->branch_name }}</option>
                    @endisset
                @endforeach
            </select>
            <label for="branch_id">Branch</label>
            @if ($errors->has('branch_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('branch_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row {{ $errors->has('marketing_source_ids') ? ' is-invalid' : '' }}">
    <div class="col-12">
        <div class="form-material">
            <select class="js-select2 form-control" id="marketing_source_ids" value="{{ isset($event) ? $event->marketing_source_ids : ''}}" name="marketing_source_ids[]" style="width: 100%;" data-placeholder="Choose one.." multiple required {{ isset($disabled) ? 'disabled="disabled"' : '' }}>
                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach($marketingSources as $marketingSource)
                    <option value="{{ $marketingSource->marketing_source_id }}">{{ $marketingSource->marketing_source_name }}</option>
                @endforeach
            </select>
            <label for="marketing_source_ids">Marketing Source</label>
            @if ($errors->has('marketing_source_ids'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('marketing_source_ids') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-12">
        <div class="form-material">
            <label>Event Close (if blank, event will be close automatically at h-1)</label>
        <input type="text" id="date" name="event_close" value="{{ isset($event) ? $event->event_close : '' }}" placeholder="Please enter date" class="js-flatpickr form-control" autocomplete="off" data-allow-input="false" data-enable-time="true" data-min-date="{{ Carbon\Carbon::now()->subDay()->format('Y-m-d') }}" data-time_24hr="true" {{ isset($disabled) ? 'disabled="disabled"' : '' }}/>
        </div>
    </div>
</div>

{{-- <div class="form-group row">
    <div class="col-6">
        <label>Activate Event</label>
        <br>
        <label class="css-control css-control-sm css-control-primary css-radio disabled">
            @isset($event)
                @if($event->is_open)
                    <input type="radio" class="css-control-input" name="is_open" value="1" required checked disabled>
                @else
                    <input type="radio" class="css-control-input" name="is_open" value="1" required disabled>
                @endif
            @else
                <input type="radio" class="css-control-input" name="is_open" value="1" required disabled>
            @endisset
            <span class="css-control-indicator"></span> Yes
        </label>
        <label class="css-control css-control-sm css-control-primary css-radio disabled">
            @isset($event)
                @if(!$event->is_open)
                    <input type="radio" class="css-control-input" name="is_open" value="0" required checked disabled>
                @else
                    <input type="radio" class="css-control-input" name="is_open" value="0" required disabled>
                @endif
            @else
                <input type="radio" class="css-control-input" name="is_open" value="1" required disabled>
            @endisset
            <span class="css-control-indicator"></span> No
        </label>
    </div>
</div> --}}


{{-- <div class="form-group row">
    <div class="col-12">
        <div class="form-material">
            <label for="material-form-slug">Slug</label>
            <div class="input-group">
                <div class="input-group-append">
                        <span class="input-group-text">https://master.suneducationgroup.com/</span>
                    <span class="input-group-text">/</span>
                </div>
                <input type="text" class="form-control" id="permalink" name="slug" readonly="readonly" required="required">
            </div>
        </div>
    </div>
</div> --}}


@section('css_before')
    <link rel="stylesheet" href="{{ asset('/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/plugins/select2/css/select2.min.css') }}">
@endsection

@section('js_after')
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>jQuery(function(){ Codebase.helpers(['flatpickr','colorpicker','select2',]); });</script>
    <script>
        @isset($event)
            @if(!is_null($event->marketing_source_ids))
                $(document).ready(function(){
                    var marketing_source_ids = {!! $event->arrMarketingSourceIds() !!};
                    $('#marketing_source_ids').val(marketing_source_ids).trigger('change');
                });
            @endif
        @endisset
    </script>
@endsection

