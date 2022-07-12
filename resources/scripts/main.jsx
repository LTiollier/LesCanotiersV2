import React from 'react'
import { createInertiaApp } from '@inertiajs/inertia-react'
import { render } from 'react-dom'
import BaseLayout from './layouts/BaseLayout'
import { InertiaProgress } from '@inertiajs/progress'

InertiaProgress.init()

createInertiaApp({
    resolve: async (name) => {
        const module = await resolveNestedRoute(name)
        const page = module.default;
        console.log(page)
        page.layout ??= (page) => <BaseLayout>{page}</BaseLayout>
        return page
    },
    setup({el, App, props}) {
        render(<App {...props} />, el)
    },
})

function resolveNestedRoute(name) {
    // fix for @rollup/plugin-dynamic-import-vars limitation
    // https://github.com/rollup/plugins/tree/master/packages/dynamic-import-vars#globs-only-go-one-level-deep
    switch (name.split('/').length) {
        case 1:
        default:
            return import(`./pages/${name}.jsx`)
        case 2: {
            const [lvl1, file] = name.split('/')
            return import(`./pages/${lvl1}/${file}.jsx`)
        }
        case 3: {
            const [lvl1, lvl2, file] = name.split('/')
            return import(`./pages/${lvl1}/${lvl2}/${file}.jsx`)
        }
        case 4: {
            const [lvl1, lvl2, lvl3, file] = name.split('/')
            return import(`./pages/${lvl1}/${lvl2}/${lvl3}/${file}.jsx`)
        }
    }
}
