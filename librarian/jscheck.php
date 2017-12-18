<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>
 $('input:radio[name="discount"]').change(function() {
        if ($(this).val()=='Yes') {
            $('#discountselection').attr('disabled',true);
        } else
            $('#discountselection').removeAttr('disabled');
    });
</script>
</head>
<body>

<td colspan="4">
<input name="discount" type="radio" id="Yes" value="Yes" />Yes
<input name="discount" type="radio" id="No" value="No" checked="checked" />No<br />  
<select class="purple" name="discountselection" id="discountselection">
<option value="1 Year" selected="selected">1 Year</option>
<option value="2 Years">2 Years</option>
<option value="3 Years">3 Years</option>
</select>                  
</td>

</body>
</html>
