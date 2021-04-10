<template>
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <Table></Table>
                <Add></Add>

            </div>
        </div>
    </div>
</template>

<script>
import Table from "./Table";
import Add from "./Add";

export default {
    name: 'VehiclesIndex',
    components: {Table, Add}
}
</script>
