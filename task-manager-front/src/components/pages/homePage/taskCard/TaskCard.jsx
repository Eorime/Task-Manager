import React from "react";
import {
	BottomContainer,
	CalendarSvg,
	Container,
	DateContainer,
	PriorityContainer,
	PriorityLabel,
	StatusLabel,
	TaskDescription,
	TaskLine,
	TaskTitle,
	TextContainer,
	TopContainer,
} from "./styles";

const TaskCard = ({ taskData }) => {
	const priorityColors = [
		{
			label: "Low",
			color: "#73D5A0",
			fill: "#C9F6DC",
			stroke: "#B0EDCC",
		},
		{
			label: "Medium",
			color: "#E6B157",
			fill: "#FBE7CA",
			stroke: "#F9D697",
		},
		{
			label: "High",
			color: "#D35462",
			fill: "#FEC7CB",
			stroke: "#FFB7BD",
		},
	];

	const currentPriority = priorityColors.find(
		(priority) => priority.label === taskData.priority_name
	);

	return (
		<Container>
			<TopContainer>
				<PriorityContainer {...currentPriority}>
					<PriorityLabel {...currentPriority}>
						{taskData.priority_name}
					</PriorityLabel>
				</PriorityContainer>
				<StatusLabel>{taskData.status_name}</StatusLabel>
			</TopContainer>
			<TextContainer>
				<TaskTitle>{taskData.title}</TaskTitle>
				<TaskDescription>{taskData.description}</TaskDescription>
			</TextContainer>
			<TaskLine></TaskLine>
			<BottomContainer></BottomContainer>
		</Container>
	);
};

export default TaskCard;
