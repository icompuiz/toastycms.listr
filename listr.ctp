<?php

	if (isset($id)) {

		$links = isset($links) ? $links : true;
		
		$property = isset($property) ? $property : false;

		$link_attributes = isset($link_attributes) ? $link_attributes : array();
		$list_attributes = isset($list_attributes) ? $list_attributes : array();
		$item_attributes = isset($item_attributes) ? $item_attributes : array();

		$link_attributes = $this->implode_associative($link_attributes);
		$item_attributes = $this->implode_associative($item_attributes);
		$list_attributes = $this->implode_associative($list_attributes);
			
		$item_template = isset($item_template) ? $item_template : null;

		$content = $this->getContent($id);

		if (!empty($content)) {

			$children = isset($content['ChildContent']) ? $content['ChildContent'] : array();

			$item_format = "<li%s>%s</li>";
			$list_format = "<ul%s>%s</ul>";
			$list_output = "";
			
			foreach ($children as $item) {

				if ($property) {
					
					$item_output = $this->property($item['id'], $property);
					$item_output = sprintf($item_format, $item_attributes, $item_output);
					
				}  elseif ($links) {
					
					$item_link = $this->Html->link($item['name'], '/content/' . $item['id'], $link_attributes);
					$item_output = sprintf($item_format, $item_attributes, $item_link);
					
					
					
				} else {
					
					$item_output = sprintf($item_format, $item_attributes, $item['name']);
					
				}

				$list_output .= $item_output;
			}

			echo sprintf($list_format, $list_attributes, $list_output);

		} else {

			echo "<!--No content with id: $id-->";

		}



	}

?>
