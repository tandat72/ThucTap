@foreach ($test as $test)
<tr>
  <td>{{ $test->id }}</td>
  <td>{{ $test->ten }}</td>
  <td>{{ $test->lop }}</td>
  <td>
    <button class="expand" data-toggle="collapse" data-target="#collapse{{ $test->id }}">+</button>
  </td>
</tr>

<tr>
  <td colspan="5" class="hiddenRow">
    <div class="collapse" id="collapse{{ $test->id }}">
       {!! $test->lop !!}
    </div>
  </td>
</tr>

@endforeach