<template>
    <swiper
        :slides-per-view="3"
        :space-between="50"
        @swiper="onSwiper"
        @slideChange="onSlideChange"
    >
        <swiper-slide>Slide 1</swiper-slide>
        <swiper-slide>Slide 2</swiper-slide>
        <swiper-slide>Slide 3</swiper-slide>
        ...
    </swiper>
</template>
<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    methods: {
        onSwiper(swiper) {
            console.log(swiper)
        },
        onSlideChange() {
            console.log('slide change')
        },
    },
};
</script>
