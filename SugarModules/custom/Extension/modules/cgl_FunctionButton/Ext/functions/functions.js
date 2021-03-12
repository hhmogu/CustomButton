function CustomButton(url){
	this.url = url;
}

CustomButton.prototype = {
	constructor: CustomButton,
	deal_event_function:function(callback){
		YAHOO.util.Connect.asyncRequest("GET", this.url,callback);
	}
}