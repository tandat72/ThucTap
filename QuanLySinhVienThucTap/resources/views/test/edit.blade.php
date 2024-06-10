<form method="POST" action="/tests/{{ $test->id }}">

    @csrf 
    @method('PUT')
  
    <div>
      <label>Idtest:</label>
      <input type="text" name="idtest" value="{{ $test->idtest }}">
    </div>
  
    <div>
      <label>Sinh viên:</label> 
      <input type="text" name="sinhvien" value="{{ $test->sinhvien }}">
    </div>
  
    <button type="submit">Cập nhật</button>
  
  </form>