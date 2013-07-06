/* ====================================================================
 * bootstrap-AJAXselect.js v0.1.0
 * for GSOA pliugn
 * ====================================================================
 * Copyright (c) 2013, Gemerz.
 * Website: http://gemerz.com
 * All rights reserved.
 * ==================================================================== */



!function ($) {

  'use strict'; // jshint ;_;
  
  var AJAXselect = function(element,options){
	  this.element = $(element)
	 this.options = $.extend({}, $.fn.AJAXselect.defaults, options)
	 var triger = this.element.attr('data-getList')
	 if(triger === 'true'){
		 this.getList()
	 }else{
		 this.init()
	 }

  }
  AJAXselect.prototype={
		  constructor:AJAXselect
		  ,init:function () {
			  var $this = this.element,
	  		  lang = this.options.lang,
	  		  wd =this.options.width,
	  		  field=this.options.field,
			  selector = $this.attr('data-toggle'),
			  url =this.options.url,
			  pid =$this.attr('data-pid'),
			  selected =$this.attr('data-selected'),
			  selected_arr = [];
			   if(selected != undefined && selected != '0'){
		        	if(selected.indexOf('|')){
		        		selected_arr = selected.split('|');
		        	}else{
		        		selected_arr = [selected];
		        	}
		        }
			   $this.nextAll('.'+selector).remove();
			  console.log($('.controls').nextAll());
			  $this.css({width:wd});
			  $('<option value="0">--'+ lang +'--</option>').appendTo($this);
			  $.getJSON(url,{id:pid},function(data){
				  if(data.status =='1'){
					  for(var i=0;i<data.data.length;i++){
						  $('<option value="'+data.data[i].id+'">'+data.data[i].name+'</option>').appendTo($this);
				  }
				  }  
				  if(selected_arr.length > 0){
					  $this.find('option[value="'+selected_arr[0]+'"]').attr("selected", true);
					  $this.trigger('change');
				  }
			  });
			
				
			  var j = 1;
			  $(document).off('change.AJAXselect.data-api').on('change.AJAXselect.data-api','[data-toggle="AJAXselect"]',function(e){
				  e.preventDefault();
					var _this = $(this),
		            _pid = _this.val();
					_this.nextAll('.'+selector).remove();
					if(_pid != ""){
		  				$.getJSON(url,{id:_pid},function(data){
		  					if(data.status == 1){
		  						var $html = $('<select class="AJAXselect" data-toggle="AJAXselect" data-pid="'+_pid+'"><option value="">--'+lang +'--</option></select>')
		  						$html.css({width:wd});
		  						 for(var i=0;i<data.data.length;i++){
		  							 $('<option value="'+data.data[i].id+'">'+data.data[i].name+'</option>').appendTo($html);
		  							 $html.insertAfter(_this);
		  						 }
		  				         if(selected_arr[j] != undefined){
		  				        	$html.find('option[value="'+selected_arr[j]+'"]').attr("selected", true);
		  				        	$html.trigger('change');
		 			            }
		  				       j++;
		  					}
		  				});
		  				$('#'+field).val(_pid);
		  			}else{
		  				
		  				$('#'+field).val(_this.attr('data-pid'));
		  			}
					
					 
			  });
  			 
  		 },getList:function(){
  			  var $this = this.element,
  			  wd =this.options.width,
  			  role_id = $('#roleid').val(),
  			  lang = this.options.lang,
  			  url =this.options.url,
  			  selector = $this.attr('data-toggle');
  			  $this.nextAll('.'+selector).remove();
  			  $this.css({width:wd});
  			 $('<option value="0">--'+ lang +'--</option>').appendTo($this);
  			 $.getJSON(url,function(data){
  				  if(data.status =='1'){
  						if(typeof role_id == 'undefined'){
  							 for(var i=0;i<data.data.length;i++){
  	  							 
  	  							$('<option value="'+data.data[i].id+'">'+data.data[i].name+'</option>').appendTo($this);
  	  						 }
  							
  						}else if(typeof role_id == 'string'){
  							for(var i=0;i<data.data.length;i++){
 	  							 
  								 if(data.data[i].id === role_id){
  									  var select ='selected="selected"';
  								  }else{
  									  var select =' ';
  								  };
  								  $('<option value="'+data.data[i].id+'"'+select+'>'+data.data[i].name+'</option>').appendTo($this);
  	  						 }
  							
  						}

				  }  
  			 });
  			 
  		 }
  	
  }

  /*
	 * AJAXselect PLUGIN DEFINITION =====================
	 */
  var old = $.fn.AJAXselect

  $.fn.AJAXselect = function ( option ) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('AJAXselect'),
        options = $.extend({}, $.fn.AJAXselect.defaults, $this.data(), typeof option == 'object' && option)
      if (!data) $this.data('AJAXselect', (data = new AJAXselect(this,options)))
      if (typeof option == 'string') data[option]()
      
    })
  }
  $.fn.AJAXselect.defaults = {
	      field:'cate_id',
	      width:'110',
	      lang:'请选择',
	  }
  $.fn.AJAXselect.Constructor = AJAXselect
 
  /*
	 * AJAXselect NO CONFLICT ===============
	 */

   $.fn.AJAXselect.noConflict = function () {
     $.fn.AJAXselect = old
     return this
   }
  /*
	 * AJAXselect LOAD ===============
	 */


}(window.jQuery);


