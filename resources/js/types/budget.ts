
type BudgetType = 'general' | 'goal'

export type Budget = {
    id: number
    name: string
    amount: string
    type: BudgetType
    create_at: string
    expenses : Expense[]
}
