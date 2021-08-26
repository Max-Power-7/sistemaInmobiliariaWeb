<template>
  <div>
    <!-- <app-header></app-header> -->
    <router-view></router-view>

    <!-- <app-footer></app-footer> -->
  </div>
</template>

<script>
import Header from "../shared/header.vue";
import Footer from '../shared/footer.vue';

export default {
	components: {
		"app-header": Header,
		"app-footer": Footer,
	},
	mounted(){
		// $(document).ready(function(){
		// 	$('.ir-arriba').click(function(){
		// 		$('body, html').animate({
		// 			scrollTop: '0px'
		// 		}, 300);
		// 	});
		
		// 	$(window).scroll(function(){
		// 		if( $(this).scrollTop() > 0 ){
		// 			$('.ir-arriba').slideDown(300);
		// 		} else {
		// 			$('.ir-arriba').slideUp(300);
		// 		}
		// 	});
		// });
	}
};
</script>