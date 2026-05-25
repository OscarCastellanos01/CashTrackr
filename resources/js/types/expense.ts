type CategoryValue =
    | 'food'
    | 'transportation'
    | 'health'
    | 'entertaiment'
    | 'subscriptions'
    | 'beauty'
    | 'clothing'
    | 'home'
    | 'education'
    | 'pets'
    | 'oather';

export type Expense = {
    id: number;
    name: string;
    amount: string;
    created_at: string;
    category: CategoryValue;
    category_label: string;
    category_color: string;
};