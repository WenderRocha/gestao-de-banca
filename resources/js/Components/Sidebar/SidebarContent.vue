<script setup>
import PerfectScrollbar from '@/Components/PerfectScrollbar.vue'
import SidebarLink from '@/Components/Sidebar/SidebarLink.vue'
import { DashboardIcon } from '@/Components/Icons/outline'
import SidebarCollapsible from '@/Components/Sidebar/SidebarCollapsible.vue'
import SidebarCollapsibleItem from '@/Components/Sidebar/SidebarCollapsibleItem.vue'
import { TemplateIcon } from '@heroicons/vue/outline'
</script>

<template>
    <PerfectScrollbar tagname="nav" aria-label="main" class="relative flex flex-col flex-1 max-h-full gap-4 px-3">
        <SidebarLink title="Dashboard" :href="route('dashboard')" :active="route().current('dashboard')">
            <template #icon>
                <DashboardIcon class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </template>
        </SidebarLink>

        <SidebarLink title="Carteiras" :href="route('wallet.index')" :active="route().current('wallet.index')">
            <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="flex-shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3
                            0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 
                            01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 
                            12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 
                            003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 
                            003 6v3" />
                </svg>
            </template>
        </SidebarLink>

        <SidebarLink title="Transações" :href="route('transacoes.index')" :active="route().current('transacoes.index')">
            <template #icon>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                  </svg>
                  
            </template>
        </SidebarLink>

        <SidebarCollapsible title="Components" :active="route().current('components.*')">
            <template #icon>
                <TemplateIcon class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </template>

            <SidebarCollapsibleItem :href="route('components.buttons')" title="Buttons"
                :active="route().current('components.buttons')" />
        </SidebarCollapsible>

        <!-- Examples -->
        <!--
        => External link example
        <SidebarLink
            title="Github"
            href="https://github.com/kamona-wd/kui-laravel-breeze"
            external
            target="_blank"
        >
        </SidebarLink>

        => Collapsible examples
        <SidebarCollapsible title="Users" :active="$page.url.startsWith('/users')">
            <SidebarCollapsibleItem :href="route('users.index')" title="List" :active="$page.url === '/users/index'" />
            <SidebarCollapsibleItem :href="route('users.create')" title="Create" :active="$page.url === '/users/create'" />
        </SidebarCollapsible>

        <SidebarCollapsible title="Users" :active="usePage().url.value.startsWith('/users')">
            <template #icon>
                <UserIcon
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>

            <SidebarCollapsibleItem :href="route('users.index')" title="List" :active="route().current('users.index')" />
            <SidebarCollapsibleItem :href="route('users.create')" title="Create" :active="route().current('users.create')" />
        </SidebarCollapsible>-->
    </PerfectScrollbar>
</template>
