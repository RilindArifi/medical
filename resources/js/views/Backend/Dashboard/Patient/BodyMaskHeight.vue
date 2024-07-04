<template>
    <div class="weight-blk">
        <div class="center slider">
            <Carousel
                :wrap-around="true"
                :settings="settings"
                :breakpoints="breakpoints"
            >
                <Slide v-for="item in BodyMaskHeight" :key="item.id">
                    <div>
                        <h4>{{ item.Height }}</h4>
                        <span>cm</span>
                    </div>
                </Slide>
                <template #addons> </template>
            </Carousel>
        </div>
    </div>
</template>

<script>
import { Carousel, Slide } from "vue3-carousel";
import "vue3-carousel/dist/carousel.css";
import BodyMaskHeight from "@/assets/json/body-mask-height.json";
export default {
    data() {
        return {
            BodyMaskHeight: BodyMaskHeight,
            settings: {
                itemsToShow: 1,
                snapAlign: "center",
            },
            breakpoints: {
                575: {
                    itemsToShow: 5,
                    snapAlign: "center",
                },
                767: {
                    itemsToShow: 5,
                    snapAlign: "center",
                },
                991: {
                    itemsToShow: 5,
                    snapAlign: "center",
                },
                1024: {
                    itemsToShow: 4.5,
                    snapAlign: "start",
                },
            },
        };
    },
    components: {
        Carousel,
        Slide,
    },
};
</script>
