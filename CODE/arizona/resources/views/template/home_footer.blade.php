<!-- jQuery -->
<script src="{{ url('/admin/js/jquery.min.js') }}"></script>
<script src="{{ url('/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ url('/admin/js/popper.min.js') }}"></script>
<script src="{{ url('/admin/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ url('/admin/js/custom.js') }}"></script>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('.dropdown-custom').click(function(e){
  $(this).parent().toggleClass('active');
});
	});

</script>
</body>
</html>