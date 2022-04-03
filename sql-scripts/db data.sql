INSERT INTO `roles` (`role_id`, `role_name`) VALUES (NULL, 'admin');
INSERT INTO `roles` (`role_id`, `role_name`) VALUES (NULL, 'subdivision manager');
INSERT INTO `roles` (`role_id`, `role_name`) VALUES (NULL, 'building manager');
INSERT INTO `roles` (`role_id`, `role_name`) VALUES (NULL, 'apartment owner');

INSERT INTO `utilities` (`utility_id`,`utility_name`) VALUES (NULL, 'electricity');
INSERT INTO `utilities` (`utility_id`,`utility_name`) VALUES (NULL, 'gas');
INSERT INTO `utilities` (`utility_id`,`utility_name`) VALUES (NULL, 'water');
INSERT INTO `utilities` (`utility_id`,`utility_name`) VALUES (NULL, 'internet');

INSERT INTO `community_services` (`community_service_id`,`community_service_name`) VALUES (NULL, 'maintenance fee');
INSERT INTO `community_services` (`community_service_id`,`community_service_name`) VALUES (NULL, 'pool');
INSERT INTO `community_services` (`community_service_id`,`community_service_name`) VALUES (NULL, 'gym');

--Admin
INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email_id`, `password`, `area_code`, `phone_number`, `joining_datetime`, `roles_role_id`) VALUES (NULL, 'Admin', 'Admin', 'admin@gmail.com', '00ba7ceab606427071d5d755ea99e976', '123', '1234562222', '2021-01-01 06:31:03', (select role_id from roles where role_name = 'admin'));


INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email_id`, `password`, `area_code`, `phone_number`, `joining_datetime`, `roles_role_id`) VALUES (NULL, 'Ichigo', 'Kurosaki', 'ao@gmail.com', 'ao', '123', '1234562', '2021-03-01 06:31:03', '4');

update subdivisions set users_user_id=2 where subdivision_name='Dwarka';
update subdivisions set users_user_id=5 where subdivision_name='Sky';

select * from users as u 
inner join subdivisions as s 
on u.user_id = s.users_user_id
inner join roles as r 
on u.roles_role_id=r.role_id
where r.role_name = 'subdivision manager';

select * from users as u 
inner join subdivisions as s 
on u.user_id = s.users_user_id
inner join roles as r 
on u.roles_role_id=r.role_id;

-- Add BM 1
INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email_id`, `password`, `area_code`, `phone_number`, `joining_datetime`, `roles_role_id`) 
VALUES (NULL, 'Arya', 'Stark', 'arya@gmail.com', 'arya', '12354', '123456232', '2021-03-01 06:31:03', '3');
-- Add BM 2
INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email_id`, `password`, `area_code`, `phone_number`, `joining_datetime`, `roles_role_id`) 
VALUES (NULL, 'Sansa', 'Stark', 'sansa@gmail.com', 'sansa', '10001', '1239876232', '2021-03-02 06:31:03', '3');




SELECT b.building_name, a.apartment_number, aub.utility_monthly_bill_amount, aub.month, aub.year, u.utility_name from apartment_utility_bills as aub
inner join apartments as a on aub.apartments_apartment_id = a.apartment_id
inner join buildings as b on aub.buildings_building_id = b.building_id
inner join utilities as u on aub.utilities_utility_id = u.utility_id
WHERE aub.subdivisions_subdivision_id = 4
and aub.month = 4 and aub.year = 2021;

SELECT b.building_name, a.apartment_number, aub.utility_monthly_bill_amount, aub.month, aub.year, u.utility_name from apartment_utility_bills as aub
inner join apartments as a on aub.apartments_apartment_id = a.apartment_id
inner join buildings as b on aub.buildings_building_id = b.building_id
inner join utilities as u on aub.utilities_utility_id = u.utility_id
WHERE aub.subdivisions_subdivision_id = 4
and aub.month = 4 and aub.year = 2021
and u.utility_name='electricity';


SELECT SUM(aub.utility_monthly_bill_amount), u.utility_name from apartment_utility_bills as aub
		inner join utilities as u on aub.utilities_utility_id = u.utility_id
		WHERE aub.subdivisions_subdivision_id = 4
		and aub.year = 2021 and aub.month = 4
		and u.utility_name = 'electricity';

drop table addresses;
drop table apartment_community_service_bills;
drop table apartment_utility_bills;
drop table apartment_utility_service_provider_type;
drop table apartments;
drop table archived_monthly_building_utility_bills;
drop table buildings;
drop table chat_messages;
drop table community_services;
drop table complaints;
drop table it_requests;
drop table maintenance_requests;
drop table responsible_contacts;
drop table roles;
drop table subdivisions;
drop table users;
drop table users_conversation;
drop table utilities;
drop table addresses;
drop table apartment_community_service_bills;
drop table apartment_utility_bills;
drop table apartment_utility_service_provider_type;
drop table apartments;
drop table archived_monthly_building_utility_bills;
drop table buildings;
