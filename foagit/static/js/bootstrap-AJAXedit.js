/* ====================================================================
 * bootstrap-AJAXedit.js v0.1.0
 * for GSOA pliugn
 * ====================================================================
 * Copyright (c) 2013, Gemerz.
 * Website: http://gemerz.com
 * All rights reserved.
 * ==================================================================== */



!function ($) {

  'use strict'; // jshint ;_;
  
  var AJAXedit = function(element,options){
	  this.element = $(element)
	  this.options = $.extend({}, $.fn.AJAXedit.defaults, options)
	  this.init()
	 
  }
  AJAXedit.prototype={
		  constructor:AJAXedit
		  ,init:function () {
			  var $this = this.element,
			  id =$this.attr('data-editid'),
			  field=$this.attr('data-editfield'),
			  url = $this.attr('data-editurl'),
			  value=$this.attr('data-value'),
			  type=$this.attr('data-editype');
			 
			  if(type == "single"){
				  var val =(value%2 ==0) ? 1 :0;
				 $.get(url,{id:id,field:field,val:val},function(data){
					if(data.status ==1){
						window.location.reload();
					}
				 });
			  }
			 if(type=="word"){
				 var width =$this.width()+10;
				 $this.parents('td').append('<input class="fieldedit" style="width:'+width+'px" value="'+value+'"/>');
				 $this.css({display:'none'});
				 $('.fieldedit').focus();
				 $('.fieldedit').blur(function(){
					 var val =  $(this).val();
					$.get(url,{id:id,field:field,val:val},function(data){
						if(data.status ==1){
							window.location.reload();
						}
					});
					 $(this).css({display:'none'});
					 $this.css({display:'block'});
					 
					 
				 });
				 
			 }
	  
  		 },
  		 cover:function(){
  			 var $this = this.element;
  			 
  			 
  		 }
  	
  }

  /*
	 * AJAXedit PLUGIN DEFINITION =====================
	 */
  var old = $.fn.AJAXedit

  $.fn.AJAXedit = function ( option ) {
    return this.each(function () {
      var $this = $(this)
        , data = $this.data('AJAXedit'),
        options = $.extend({}, $.fn.AJAXedit.defaults, $this.data(), typeof option == 'object' && option)
      if (!data) $this.data('AJAXedit', (data = new AJAXedit(this,options)))
      if (typeof option == 'string') data[option]()
      
    })
  }
  $.fn.AJAXedit.defaults = {
	      field:'cate_id',
	      width:'110',
	      lang:'请选择',
	  }
  $.fn.AJAXedit.Constructor = AJAXedit
 
  /*
	 * AJAXedit NO CONFLICT ===============
	 */

   $.fn.AJAXedit.noConflict = function () {
     $.fn.AJAXedit = old
     return this
   }
  /*
	 * AJAXedit LOAD ===============
	 */
  $(document).on('click.AJAXedit.data-api', '[data-toggle="AJAXedit"]', function (e) {
	  var $this = $(this);
	  $(this).AJAXedit();
	  
	  
  });
  /*
	 * AJAXedit extend del ===============
	 */
  $(document).on('click.AJAXedit.data-api', '[data-toggle="AJAXdelete"]', function (e) {
	  var $this = $(this),
	  		url =$this.attr('data-url');
	  	 $.get(url,function(data){
	  		if(data.status ==1){
	  			window.location.reload();
	  		}
	  		
	  	 })
	 
	  
	  
  });
}(window.jQuery);


