function InformationCheck(){
	var url = '123';
	var customButton = new CustomButton(url);

	var callback = {
	    success: function(result) {
	        alert('1');//可调用模态框提示
	    },
	    failure: function(result) {
	        alert('0');
	    }
	}	
	customButton.deal_event_function(callback);
}