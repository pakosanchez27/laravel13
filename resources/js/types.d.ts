import '@inertiajs/core';

declare module '@inertiajs/core/' {
    export interface InertiaConfig {
        sharePageProps: {
            flash: {
                success?: string
            },
            user: {
                id: number,
                name: string,
                email: string,
            }
        }
    }
}
