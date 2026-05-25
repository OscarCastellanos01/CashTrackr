import '@inertiajs/core'

declare module '@inertiajs/core' {
    export interface InteraConfig {
        sharedPageProps: {
            flash: {
                success?: string
            }
        }
    }
}