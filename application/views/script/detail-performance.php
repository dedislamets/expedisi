<script type="text/javascript">
	$(document).ready(function(){ 
		$('#myCarousel').carousel({
		  interval: 4000
		})

		$('.carousel .item').each(function(){
		  var next = $(this).next();
		  if (!next.length) {
		    next = $(this).siblings(':first');
		  }
		  next.children(':first-child').clone().appendTo($(this));
		  
		  for (var i=0;i<2;i++) {
		    next=next.next();
		    if (!next.length) {
		    	next = $(this).siblings(':first');
		  	}
		    
		    next.children(':first-child').clone().appendTo($(this));
		  }
		});    

		// $('#ViewTable').DataTable({
		// 	ajax: {		            
	 //            "url": "EmployeePerformance/dataTable",
	 //            "type": "GET"
	 //        },			
		// 	"bPaginate": true,	
		// 	"ordering": false,
		// 	columnDefs:[
		// 			{
		// 				targets:[3,4], render:function(data){
		// 	      			return moment(data).format('DD MMM YYYY'); 
		// 	    		}
		// 	    	},
		// 	]

	 //    });

	});
</script>