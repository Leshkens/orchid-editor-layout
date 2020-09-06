import EditorJS from '@editorjs/editorjs'

import DelimiterTool from '@editorjs/delimiter'
import HeaderTool from '@editorjs/header'
import ListTool from '@editorjs/list'
import MarkerTool from '@editorjs/marker'
import ParagraphTool from '@editorjs/paragraph'

export default class extends window.Controller {

    tools = {
        delimiter: DelimiterTool,
        paragraph: ParagraphTool,
        header: HeaderTool,
        list: ListTool,
        marker: MarkerTool
    }

    static targets = [
        'input'
    ]

    initialize () {
        let customTools = window.editorLayoutTools
        if (typeof customTools !== 'undefined' && customTools instanceof Object) {
            this.tools = Object.assign(customTools, this.tools)
        }
    }

    connect () {

        let placeholder = this.data.get('placeholder')
        let autofocus = this.data.get('autofocus')
        let logLevel = this.data.get('log-level')
        let minHeight = this.data.get('min-height')

        console.log(this.tools)

        const editor = this.editor = new EditorJS({

            data: this.parseJson(this.inputTarget.value),

            i18n: {
                messages: this.parseJson(this.data.get('localization'))
            },

            minHeight: minHeight,

            tools: this.getTools(),

            placeholder: placeholder,

            logLevel: logLevel,

            holder: this.element,

            autofocus: autofocus === 'true',

            onChange: (event) => {
                event.saver.save().then(outputData => {
                    this.inputTarget.value = JSON.stringify(outputData)
                })
            },
        })

    }

    getTools () {
        let tools = this.parseJson(this.data.get('tools'))

        if (tools !== null && tools instanceof Object) {

            Object.keys(tools).map((key) => {

                if (this.tools.hasOwnProperty(key)) {

                    tools[key]['class'] = this.tools[key]

                } else {

                    delete tools[key]

                    console.error(key + ' object not found')
                }
            })
        }
        return tools
    }

    // isJson (string) {
    //     try {
    //         JSON.parse(string)
    //     } catch (e) {
    //         return false
    //     }
    //     return true
    // }

    parseJson (json) {
        let result
        try {
            result = JSON.parse(json)
        } catch (e) {
            result = null
        }
        return result
    }

}
