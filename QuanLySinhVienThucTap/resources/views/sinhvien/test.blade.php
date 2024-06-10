<form method="POST" action="{{ route('sinhvien/test.index') }}">

    @csrf
    <select name="students[]" multiple>
        @foreach($students as $student) 
          <option value="{{$student->id}}">{{$student->name}}</option>
        @endforeach
      </select>
    <button type="submit">Submit</button>
  
  </form>
  
  @if($message = Session::get('success'))
  <div>{{$message}}</div>

  @foreach($interns as $intern)
    {{$intern->name}} <br>
  @endforeach
@endif