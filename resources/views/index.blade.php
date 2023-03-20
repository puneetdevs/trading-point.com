@extends('layouts.app')
@section('content')
    <x-common.card>
        @slot('card_content')
            <div>
        
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-12">

                            <x-common.messages />
                            
                            <div class="card">
                                <div class="card-header">{{ __('Form') }}</div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('submit') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="company_symbol" class="form-label mb-1">Company Symbol</label>
                                            <select class="form-select" id="company_symbol" name="company_symbol" required>
                                                <option value="" selected>Select an Company Symbol</option>
                                                @foreach ($companies as $company_symbol)
                                                    <option value="{{ $company_symbol }}" {{ old('company_symbol')== $company_symbol ? 'selected' : '' }}>{{ $company_symbol }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="form-group mb-3">
                                            <label for="email" class="form-label mb-1">{{ __('Email') }}</label>
                                            <input id="email" type="text"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="start_date" class="form-label mb-1">{{ __('Start Date') }}</label>
                                            <input id="start_date" type="text" readonly
                                                class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                                value="{{ old('start_date') }}" required autocomplete="start_date"
                                                placeholder="YYYY-mm-dd">

                                            @error('start_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="end_date" class="form-label mb-1">{{ __('End Date') }}</label>
                                            <input id="end_date" type="text" readonly
                                                class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                                value="{{ old('end_date') }}" required autocomplete="end_date"
                                                placeholder="YYYY-mm-dd">

                                            @error('end_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        @endslot
    </x-common.card>

    <script>
        function setDateRange(startDateId, endDateId) {
            var startDate = $(startDateId);
            var endDate = $(endDateId);

            startDate.datepicker({
                maxDate: new Date(),
                dateFormat: "yy-mm-dd"
            });
            endDate.datepicker({
                minDate: new Date(),
                dateFormat: "yy-mm-dd"
            });

            var discounStartDate;
            startDate.on('change', function(e) {
                endDate.datepicker("option", "minDate", e.target.value);
                discounStartDate = e.target.value;
                validateDates();
            });

            endDate.on('change', function(ev) {
                if (!discounStartDate) {
                    endDate.datepicker({
                        disabled: true
                    });
                }
                startDate.datepicker("option", "maxDate", ev.target.value);
                validateDates();
            });

            function validateDates() {
                var startDateVal = startDate.val();
                var endDateVal = endDate.val();
                var currentDate = new Date().toISOString().slice(0, 10);

                if (startDateVal && endDateVal) {
                    if (startDateVal > endDateVal) {
                        endDate.val(startDateVal);
                    }

                    if (startDateVal > currentDate) {
                        startDate.val('');
                        alert('Start Date cannot be greater than current date.');
                    }

                    if (endDateVal < currentDate) {
                        endDate.val('');
                        alert('End Date cannot be less than current date.');
                    }
                }
            }
        }

        setDateRange("#start_date", "#end_date");
    </script>
@endsection
