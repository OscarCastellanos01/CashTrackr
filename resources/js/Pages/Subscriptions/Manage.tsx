import { Head } from "@inertiajs/react";

export default function Manage() {

    const title = 'Administra tu suscripcion';
    return (
        <>
            <Head title={title} />

            <main className="max-w-3xl mx-auto py-12 px-4">
                <h1 className="text-3xl font-black mb-2">{title}</h1>
                <p className="text-gray-500 mb-8 text-lg">
                    Cambia tu plan, cancela o reactiva tu suscripcion cuando quieras.
                </p>
            </main>
        </>
    );
}
