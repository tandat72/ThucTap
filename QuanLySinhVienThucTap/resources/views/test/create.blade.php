// sử dụng collapse component của Bootstrap

@foreach ($test as $product)

  <tr>
    <td>{{ $product->name }}</td>
    <td>
      <a data-toggle="collapse" href="#collapse{{$product->id}}">View Details</a>

      <div id="collapse{{$product->id}}" class="collapse show">
        {{ $product->description }}
      </div>
    </td>
  </tr>

@endforeach

// gọi JS để toggle collapse
<script>
  $('a[data-toggle="collapse"]').click(function() {
    $(this).closest('tr').find('.collapse').collapse('toggle'); 
  });
</script>