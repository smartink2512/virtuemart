/**
 * VMAdmin.js: General Javascript Library for VirtueMart Administration
 *
 *
 * @package	VirtueMart
 * @subpackage Javascript Library
 * @author jseros
 * @copyright Copyright (c) 2009 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */


/**
 * Auto-executable function to avoid conflict and global variables.
 * It's not necessary to use jQuery.noConflict() 
 * 
 * @author jseros
 * @param jQuery $ Solve the scope problem and jQuery-Mootools conflict
 */

jQuery.noConflict();

(function($){
	
	/**
	 * VMAdmin namespace. 
	 * Local variable and property attached to global object
	 * 
	 * @author jseros
	 */
	var VMAdmin = window.VMAdmin = {
		
		/**
		 * cache namespace. Useful to temporal data
		 * 
		 * @author jseros
		 * 
		 */	
		cache: {
			states: [] //states cache
		},
		
		/**
		 * URL namespace. URLs to use.
		 * 
		 * @author jseros
		 * 
		 */
		
		
		URL: {
			countryStates: 'index.php?option=com_virtuemart&view=state&task=getList&format=json&country_id='
			
		},
		
		/**
		 * util namespace
		 * 
		 * @author jseros
		 * 
		 */
		util: {
			
			/**
			 * Parse country-state dependent combos
			 * The Select Element must have class="dependent[parent_id]"
			 * 
			 * TODO: Performance issues
			 * 
			 * @author jseros
			 */
			countryStateList: function(){
		
				$(function(){
					
					//Performace issue
					var successCallBack = (function(statesCombo, countryId){
						return function(states){
							VMAdmin.cache.states[countryId] = states; //store into the cache object
							$(statesCombo).empty().removeAttr('disabled');
							
							for(var i = 0, j = states.length; i < j; i++){
								$(statesCombo).append( new Option(states[i].state_name, states[i].state_id) );
							}
						};
					});
					
					$('select[class*=dependent]').each(function(){
						this.className = this.className || '';
						
						var params = /dependent\[(.*)\]/i.exec( this.className ), //extracting parent id
						that = this, //shortchut to [[this]] and scope solution
						countryId = null; 
						
						if( params && params[1]){
							       
							$('#'+ params[1]).change(function(){
								
								countryId = $(this).val();
								
								//using cache to speed up the process
								if( VMAdmin.cache.states[countryId] ){
									var states = VMAdmin.cache.states[countryId];
									for(var i = 0, j = states.length; i < j; i++){
										$(that).append( new Option(states[i].state_name, states[i].state_id) );
									}
								}
								else{
									$(that).attr('disabled', 'disabled');
									
									$.ajax({
										url: VMAdmin.URL.countryStates + countryId,
										dataType: 'json',
										success: successCallBack(that, countryId)
									});
								}
							});
						}
					});
					
				});
			}
		}
	};
	
})(jQuery);