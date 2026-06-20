import { Subscription } from "@/types/subscription"

type Props = {
    isYearly: boolean;
    color?: string;
    status_label?: Subscription["status_label"];
    price: Subscription["price"];
};

const statusColors = {
    green: "bg-green-50 text-green-600 border-green-200",
    yellow: "bg-yellow-50 text-yellow-600 border-yellow-200",
    orange: "bg-orange-50 text-orange-600 border-orange-200",
    red: "bg-red-50 text-red-600 border-red-200",
    gray: "bg-gray-50 text-gray-700 border-gray-200",
};

export default function SubscriptionStatus({isYearly, color, status_label, price} : Props) {
    return (
        <div className="rounded-xl border border-slate-300  p-6 mb-6">
            <div className="flex justify-between items-start mb-4">
                <div>
                    <span className="text-sm text-gray-500 uppercase tracking-wide">
                        Plan actual
                    </span>
                    <h2 className="text-2xl font-bold flex items-center gap-2 mt-1">
                        PRO {isYearly ? 'Anual' : 'Mensual'}
                    </h2>
                </div>
                <div className="text-right">
                    <div className="text-3xl font-black">
                        ${price}
                        <span className="text-base font-normal text-gray-500">
                            /{isYearly ? 'año' : 'mes'}
                        </span>
                    </div>
                </div>
            </div>

            <div className="border-t border-slate-300 pt-4 space-y-2 text-sm">
                <div className={`rounded-lg border p-4 mb-4`}>
                    <div className="font-bold text-xl"></div>
                </div>
            </div>
        </div>
    );
}
