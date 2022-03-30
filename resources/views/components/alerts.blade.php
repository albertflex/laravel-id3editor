@if(Session::has('message'))
<div class="w-full mb-5 mt-2 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
  <p>{{ Session::get('message') }}</p>
</div>
@endif


