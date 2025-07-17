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
			label: "low",
			color: "#73D5A0",
			fill: "#C9F6DC",
			stroke: "#B0EDCC",
		},
		{
			label: "medium",
			color: "#E6B157",
			fill: "#FBE7CA",
			stroke: "#F9D697",
		},
		{
			label: "high",
			color: "#D35462",
			fill: "#FEC7CB",
			stroke: "#FFB7BD",
		},
	];

	return (
		<Container>
			<TopContainer>
				<PriorityContainer>
					<PriorityLabel>{taskData.priority_name}</PriorityLabel>
				</PriorityContainer>
				<StatusLabel>{taskData.status_name}</StatusLabel>
			</TopContainer>
			<TextContainer>
				<TaskTitle>{taskData.title}</TaskTitle>
				<TaskDescription>{taskData.description}</TaskDescription>
			</TextContainer>
			<TaskLine></TaskLine>
		</Container>
	);
};

export default TaskCard;
