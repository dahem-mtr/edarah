<template>
    <PageLayout
        :title=" title"
        :pageTitle="pageTitle"
    >
    
        <template v-slot:navigation-links>
            <li class="breadcrumb-item active"> {{title}}</li>
        </template>

        <template v-if="tabs" v-slot:tabs>
            <nav class="nav page-tabs">
            <template  v-for="(tabTitle, i) in tabs.map((tab) => tab.title)"  :key="i">
                <a class="nav-link " @click="() => this.currentTap = tabTitle "  :class="currentTap === tabTitle ? 'active' : ''" href="#"> {{ tabTitle }} </a>
            </template>
            </nav>

        </template>
        
        <template  v-if="tabs">
        <template v-for="(tab) in  tabs">
            <template v-if="tab.title === currentTap">
            <section v-for="(section,i) in  tab.sections" :key="i">
                <h5 v-if="section.title" class="section-title"> {{ section.title }} </h5>
                <DefineAsyncContainer v-if="section.asyncSection" :container="section.asyncSection"
                                      :payload="section.payload"/>
                <component v-else :is="section.section" :payload="section.payload"></component>
            </section>
        </template>

        </template>
        </template>


        <template v-else>
            <section v-for="(section,i) in  sections" :key="i">
                <h5 v-if="section.title" class="section-title"> {{ section.title }} </h5>
                <DefineAsyncContainer v-if="section.asyncSection" :container="section.asyncSection"
                                      :payload="section.payload"/>
                <component v-else :is="section.section" :payload="section.payload"></component>
            </section>
        </template>


    </PageLayout>
</template>
<script>

    import PageLayout from "../Components/PageLayout.vue";
    import DefineAsyncContainer from "../Utils/DefineAsyncContainer.vue";
    import * as SharedContainers from "../Containers/Shared";
    export default {
        components: { PageLayout, ...SharedContainers, DefineAsyncContainer},
        props: {
            title:String,
            pageTitle:String,
            sections: Array,
            tabs: Array,
        },
        data() {
            return {currentTap:  this.tabs ? this.tabs[0].title : ''}
        },
        methods: {
            plus() {
                this.a++
            }
        },
    }
</script>
