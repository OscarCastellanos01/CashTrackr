import SubscriptionStatus from "@/Components/subscriptions/SubscriptionsStatus";
import { Subscription } from "@/types/subscription";
import { Head } from "@inertiajs/react";

type Props = {
    subscription: Subscription
}

export default function Manage({subscription} : Props) {

    const title = 'Administra tu suscripcion';

    const isYearly = subscription.plan === 'yearly';

    return (
        <>
            <Head title={title} />

            <main className="max-w-3xl mx-auto py-12 px-4">
                <h1 className="text-3xl font-black mb-2">{title}</h1>
                <p className="text-gray-500 mb-8 text-lg">
                    Cambia tu plan, cancela o reactiva tu suscripcion cuando quieras.
                </p>
            </main>

            <SubscriptionStatus
                isYearly ={isYearly}
                price={subscription.price}
            />
        </>
    );
}
