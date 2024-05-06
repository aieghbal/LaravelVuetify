<!--<template>
    <div style="width: 1024px;height: 600px;">
        <button @click="openDialog" :class="{ closeWindow: !this.close }">Open Dialog</button>
        <div ref="draggableContainer" id="draggable-container" :class="{ closeWindow: this.close, maximizeWindow: this.maximize, minimizeWindow: this.minimize }">
            <div id="draggable-header" @mousedown="dragMouseDown">
                <vue-draggable-resizable :w="100" :h="100">
                    <div class="DialogBox">
                        <CustomPanelHeader @CloseWindow="handleClose" @MaximizeWindow="handleMaximize" @MinimizeWindow="handleMinimize"/>
                        <FormValidation/>
                    </div>
                </vue-draggable-resizable>
            </div>
        </div>
    </div>
</template>-->
<template>
    <div style="width: 1024px;height: 600px;position: relative">
        <button @click="openDialog" :class="{ closeWindow: !this.close }">Open Dialog</button>
        <vue-draggable-resizable :w="600" :h="550" :class="{ closeWindow: this.close, maximizeWindow: this.maximize, minimizeWindow: this.minimize }">
            <CustomPanelHeader @CloseWindow="handleClose" @MaximizeWindow="handleMaximize" @MinimizeWindow="handleMinimize"/>
            <FormValidation/>
        </vue-draggable-resizable>
    </div>
</template>
<script>
import FormValidation from "../../src/components/FormValidation.vue";
import CustomPanelHeader from "./CustomPanelHeader.vue";
import VueDraggableResizable from 'vue-draggable-resizable'
export default {
    components: {CustomPanelHeader, FormValidation,VueDraggableResizable},
    data: () => ({
        positions: {
            clientX: undefined,
            clientY: undefined,
            movementX: 0,
            movementY: 0,
        },
        close : false,
        maximize : false,
        minimize : false,
    }),
    methods: {
        /*elementDrag: function (event) {
            event.preventDefault()
            this.positions.movementX = this.positions.clientX - event.clientX
            this.positions.movementY = this.positions.clientY - event.clientY
            this.positions.clientX = event.clientX
            this.positions.clientY = event.clientY
            this.$refs.draggableContainer.style.top = (this.$refs.draggableContainer.offsetTop - this.positions.movementY) + 'px'
            this.$refs.draggableContainer.style.left = (this.$refs.draggableContainer.offsetLeft - this.positions.movementX) + 'px'
        },
        dragMouseDown: function (event) {
            event.preventDefault()
            this.positions.clientX = event.clientX
            this.positions.clientY = event.clientY
            document.onmousemove = this.elementDrag
            document.onmouseup = this.closeDragElement
        },
        closeDragElement () {
            document.onmouseup = null
            document.onmousemove = null
        },*/
        handleClose(value){
            this.close = value;
        },
        openDialog(){
            this.close = false;
        },
        handleMaximize(value){
            this.maximize = value;
        },
        handleMinimize(value){
            this.minimize = value;
        }
    },
}
</script>
<style scoped>
@import "vue-draggable-resizable/style.css";
.draggable {

}
.DialogBox{
    padding: 5px;
    position: absolute;
    top: 1%;
    right: 1%;
    box-shadow: 1px 2px 5px 5px rgba(0,0,0,0.29);
    resize: both;
    overflow: auto;
}
.resizable-content {
    height: 100%;
    width: 100%;
    background-color: aqua;
}
.closeWindow{display: none;}
.maximizeWindow{width: 99%!important; height: 99% !important;display: block;margin: auto!important;top: -5%!important;right: 0%!important;}
.minimizeWindow {width: 200px!important;height: 50px!important;overflow: hidden;bottom: 1%!important; left: 2%!important;}
</style>
