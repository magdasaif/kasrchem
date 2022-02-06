<footer class="main-footer">
    {{-- To the right --}}
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0
    </div>
    {{-- Default to the left --}}
    <strong>Copyright &copy; 2022-2023 <a href="https://murabba.com/">Murabba</a>.</strong> All rights reserved.
  </footer>
</div>
{{-- ./wrapper --}}

@auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth
<script src="{{ mix('/js/app.js') }}"></script>

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<!-- <script src="{{ URL::asset('/js/categories.js') }}"></script> -->

<script src="{{ URL::asset('js/jquery.repeater.min.js')}}"></script>

<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" src="{{ URL::asset('dist/js/bootstrap-iconpicker.bundle.min.js')}}"></script>

</body>
</html>