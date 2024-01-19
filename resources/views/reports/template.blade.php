
<div class="max-w-md mx-auto mt-8">
        <div class="mb-4">
            @foreach ($emp as $user)
            
                {{$user->first_name}}
                {{$user->last_name}}
                {{$user->phone}}
            
            @endforeach
        </div>
    </div>

