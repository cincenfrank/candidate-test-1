<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Customer ID</label>
            <label for="customer_id"></label>
            <select class="form-control" name="customer_id" id="customer_id">
                @foreach($customers as $customer)

                <option value="{{$customer->id}}" @if($customer->id==$order->customer_id)selected

                    @endif>{{$customer->first_name . ' ' . $customer->last_name}}</option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Cost</label>
            <input type="number" name="cost" class="form-control" value="{{ old('cost', $order->cost) }}">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $order->title) }}">
        </div>
    </div>
    <div class="col-md-12">

        <div class="form-group">
            <label>Tags</label>
            <select class="form-control" multiple name="tags[]">
                @foreach($tags as $tag)

                <option value="{{$tag->id}}" @if($order->tags->contains($tag->id))
                    selected
                    @endif>{{$tag->name}}</option>
                @endforeach

            </select>
        </div>
    </div>

</div>
{{-- <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" value="{{ old('email', $customer->email) }}">
</div>
</div>
</div> --}}
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ old('description', $order->description) }}</textarea>
            {{-- <input type="text" name="description" class="form-control" value="{{ old('description', $order->description) }}"> --}}
        </div>
    </div>

</div>
