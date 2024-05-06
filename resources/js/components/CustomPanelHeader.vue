<template>
    <div class="panelHeader">
        <i class="fa fa-window-close" style="font-size:20px;" @click="closeHandler"></i>

        <i class="fa-regular fa-square" @click="RestoreHandler" :class="{ MaximizeWindow: !this.maximize }" style="font-size:20px;"></i>
        <i class="fa fa-window-maximize" @click="MaximizeHandler" :class="{ MaximizeWindow: this.maximize }" style="font-size:20px;"></i>

        <i class="fa fa-window-minimize" @click="MinimizeHandler" :class="{ MinimizeWindow: this.minimize }" style="font-size:20px"></i>
        <button @click="resetHandler" :class="{ MinimizeWindow: !this.minimize }">maximize</button>
    </div>
</template>
<script>
export default {
    data: () => ({
        maximize : false,
        minimize : false
    }),
    emits: ['CloseWindow','MaximizeWindow','MinimizeWindow'],
    methods: {
        closeHandler() {
            this.$emit('CloseWindow', true);
        },
        MaximizeHandler() {
            this.$emit('MaximizeWindow', true);
            this.maximize = true;
        },
        RestoreHandler() {
            this.$emit('MaximizeWindow', false);
            this.maximize = false;
        },
        MinimizeHandler() {
            this.$emit('MinimizeWindow', true);
            this.minimize = true;
        },
        resetHandler() {
            this.$emit('MinimizeWindow', false);
            this.minimize = false;
        }
    }
}

</script>
<style>
    .panelHeader{
        width: 100%;
        height: 40px;
    }
    .MaximizeWindow,.MinimizeWindow{
        display: none;
    }
    i:hover{cursor: pointer;}
    i{margin: 0 5px;}
</style>
