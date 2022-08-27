<div>    
    @livewire('plan-create')
    <div class="card shadow plans" style="padding: 50px; margin:100px 100px 50px 100px">
        <div class="card-body " style="height: 550px;overflow: scroll;" >
            <table class="table">
                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                </div>
                <thead>
                    <tr>
                        <th>Plan Name</th>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>Created at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($plans) == 0)
                        <tr>
                            <td colspan="5" class="text-center">There is no plan available</td>
                        </tr>
                    @endif
                    @foreach ($plans as $plan)
                    <tr>
                    <td>{{$plan->plan_name}}</td>
                    <td>{{$plan->date}}</td>
                    <td>{{$plan->duration}}
                    @if ($plan->duration == 1)
                        {{'Day'}}
                    @else
                        {{'Days'}}
                    @endif 
                    </td>
                    <td>{{$plan->created_at}}</td>
                    <td>
                        <a href="{{route('map', $plan->plan_id)}}" class="btn btn-primary">Open</a>
                        <a wire:click="deletePlan({{$plan->plan_id}})"
                        onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> 
        </div>
    </div>
    <div class="text-center" style="background-color: white">
        <a href="{{url('/')}}" class="btn btn-primary btn-lg">
            <i class="fa fa-home"></i>
            Back to Home
        </a>
    </div>
    </div>
</div>




