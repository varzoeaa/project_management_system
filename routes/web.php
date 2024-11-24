<?php

// CHARTS 

/*
2. Pie Chart: Task Priority Distribution
Purpose: Display the proportion of tasks grouped by priority (low, medium, high) from the tasks table.
Data Source: Group the tasks table by priority and count.
Use Case: Visualize the workload and critical task priorities for better resource allocation.
*/


/*
This chart assuems the project category name and the transaction_type tables categories are the same. 
As it should be.

1. Bar Chart: Project Spending by Category
Purpose: Compare total spending grouped by project categories (from project_categories).
Data Source: Join transactions (with amount as spending) to projects through a shared project relationship, then group by project_categories.name.
Use Case: Understand which project categories consume the most budget.
*/   


/*
4. Stacked Bar Chart: Expenses by Client
Purpose: Compare expenses (transactions.amount where type_name = expense) grouped by client (from the clients table).
Data Source: Join transactions to clients and group by clients.name.
Use Case: Analyze which clients are associated with the highest spending.
*/


/*
5. Key Metrics: Project and Task Stats
Purpose: Show quick insights into the current project and task statuses.
Data:
Total number of active projects (projects.status = active).
Total number of overdue tasks (tasks.deadline < now() and tasks.status != done).
Total pending appointments (appointments.status = pending).
Use Case: Provide high-level stats to monitor project and task activity.
*/


/*
8. Table Widget: Active Projects with Assignees
Purpose: Display a table showing active projects, their categories, and the total number of assignees (from project_assignees).
Data Source: Join projects to project_assignees and project_categories.
Use Case: Provide a clear overview of ongoing projects and their staffing.
*/


/*
9. Progress Widget: Task Completion by Project
Purpose: Show the percentage of completed tasks for each project.
Data Source: Calculate completed tasks (tasks.status = done) divided by total tasks grouped by project_id.
Use Case: Track progress for individual projects.
*/


/*
10. Donut Chart: Payment Status Distribution
Purpose: Display the proportion of clients grouped by their payment status (paid, unpaid, partly_paid).
Data Source: Group clients by payment_status and count.
Use Case: Provide insight into outstanding payments for better cash flow management.
*/


/*
14. Line Chart: Monthly Revenue Growth
Purpose: Visualize the monthly revenue growth over the past year.
Data Source: Group transactions by month and year, then sum the amounts for income.
Use Case: Monitor revenue growth and identify seasonal trends.
*/


