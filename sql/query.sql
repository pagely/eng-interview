# Describe what the following query is doing and what it will output

SELECT a.id, a.name, SUM(plan.price) AS total_price, GROUP_CONCAT(plans.name) AS plan_names
FROM accounts a
INNER JOIN account_subscriptions asub ON(asub.account_id=a.id)
INNER JOIN plans ON(asub.plan_id=plans.id)
GROUP BY a.id
