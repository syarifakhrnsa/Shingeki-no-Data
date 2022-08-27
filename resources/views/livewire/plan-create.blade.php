<form wire:submit.prevent="createPlan">
    <div class="container">
        <div class="container">
            <div class="bg-light shadow" style="padding: 30px; z-index: 3; position: relative;">
                <div class="row align-items-center" style="min-height: 60px;">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-3">
                                <h4 class="mb-0">Make a Whole New Plan</h4>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3 mb-md-0">
                                    <div class="mb-3 mb-md-0" style="height: 47px;">
                                        <div class="form-group">
                                            <input wire:model="plan_name" type="text" class="form-control p-4 @error('plan_name') is-invalid @enderror" placeholder="Plan Name" autocomplete="false"/>
                                            @error('plan_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <div class="mb-3 mb-md-0">
                                    <input wire:model="date" type="date" class="form-control p-4 datetimepicker-input @error('date') is-invalid @enderror" placeholder="Date" data-toggle="datetimepicker"/>
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <div class="mb-3 mb-md-0">
                                    <select wire:model="duration" class="custom-select px-4 @error('duration') is-invalid @enderror" style="height: 47px;">
                                        <option value="" selected >Duration</option>
                                        <option value="1">1 Day</option>
                                        <option value="2">2 Days</option>
                                        <option value="3">3 Days</option>
                                        <option value="4">4 Days</option>
                                        <option value="5">5 Days</option>
                                        <option value="6">6 Days</option>
                                        <option value="7">7 Days</option>
                                    </select>
                                    @error('duration')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="col-md-2">
                    <button class="btn btn-primary btn-block" type="submit" style="height: 47px; margin-top: -12px;">New Plan</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</form>
